<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ZipArchive;

class BackupController extends Controller
{
    private function backupDirectory(): string
    {
        return storage_path('app/backups');
    }

    public function index()
    {
        $directory = $this->backupDirectory();
        File::ensureDirectoryExists($directory);

        $backups = collect(File::files($directory))
            ->filter(fn ($file) => $file->getExtension() === 'zip'
                && preg_match('/^portfolio-[A-Za-z0-9_-]+\.zip$/', $file->getFilename()))
            ->sortByDesc(fn ($file) => $file->getMTime())
            ->map(fn ($file) => [
                'name' => $file->getFilename(),
                'size' => round($file->getSize() / 1048576, 2),
                'date' => date('d/m/Y H:i', $file->getMTime()),
            ])->values();

        return view('admin.backups.index', compact('backups'));
    }

    public function store()
    {
        if (!class_exists(ZipArchive::class)) {
            return back()->with('error', 'PHP chưa bật extension ZIP.');
        }

        $directory = $this->backupDirectory();
        File::ensureDirectoryExists($directory);
        $filename = 'portfolio-' . now()->format('Y-m-d_H-i-s') . '-' . Str::random(6) . '.zip';
        $destination = $directory . DIRECTORY_SEPARATOR . $filename;
        $zip = new ZipArchive();
        $opened = false;
        $closed = false;
        $temporarySql = null;

        try {
            if ($zip->open($destination, ZipArchive::CREATE | ZipArchive::EXCL) !== true) {
                throw new \RuntimeException('Không thể tạo file ZIP.');
            }
            $opened = true;

            $driver = DB::connection()->getDriverName();
            if ($driver === 'sqlite') {
                $databasePath = DB::connection()->getDatabaseName();
                if ($databasePath === ':memory:' || !File::isFile($databasePath)) {
                    throw new \RuntimeException('Không tìm thấy file SQLite để sao lưu.');
                }
                // A consistent SQLite snapshot, including data still in WAL, is needed.
                // VACUUM INTO creates an independent snapshot without copying the live DB file.
                $snapshot = $directory . DIRECTORY_SEPARATOR . 'snapshot-' . Str::random(24) . '.sqlite';
                $temporarySql = $snapshot;
                $quotedPath = str_replace("'", "''", $snapshot);
                DB::connection()->statement("VACUUM INTO '{$quotedPath}'");
                if (!$zip->addFile($snapshot, 'database/portfolio.sqlite')) {
                    throw new \RuntimeException('Không thể thêm SQLite vào ZIP.');
                }
                $databaseEntry = 'database/portfolio.sqlite';
            } elseif ($driver === 'mysql') {
                $temporarySql = $directory . DIRECTORY_SEPARATOR . 'export-' . Str::random(24) . '.sql';
                $this->exportMysqlToFile($temporarySql);
                if (!$zip->addFile($temporarySql, 'database/portfolio.sql')) {
                    throw new \RuntimeException('Không thể thêm SQL vào ZIP.');
                }
                $databaseEntry = 'database/portfolio.sql';
            } else {
                throw new \RuntimeException('Driver database chưa được hỗ trợ: ' . $driver);
            }

            $uploadDirectory = storage_path('app/public');
            if (File::isDirectory($uploadDirectory)) {
                foreach (File::allFiles($uploadDirectory) as $file) {
                    if ($file->isLink()) {
                        continue;
                    }
                    $relative = str_replace('\\', '/', $file->getRelativePathname());
                    if (!$zip->addFile($file->getPathname(), 'uploads/' . $relative)) {
                        throw new \RuntimeException('Không thể thêm file upload: ' . $relative);
                    }
                }
            }

            if (!$zip->addFromString('README.txt',
                "Laravel Personal Portfolio Backup\nCreated: " . now()->toDateTimeString() .
                "\nDatabase: {$databaseEntry}\nUploaded files: uploads/\n" .
                "Restore manually after reviewing the backup.\n")) {
                throw new \RuntimeException('Không thể thêm README vào ZIP.');
            }

            if (!$zip->close()) {
                throw new \RuntimeException('Không thể hoàn tất file ZIP.');
            }
            $closed = true;

            if (!File::isFile($destination) || File::size($destination) === 0) {
                throw new \RuntimeException('File ZIP được tạo không hợp lệ.');
            }

            return redirect()->route('admin.backups.index')
                ->with('success', 'Tạo bản sao lưu thành công!');
        } catch (\Throwable $e) {
            report($e);
            if ($opened && !$closed) {
                try { $zip->close(); } catch (\Throwable $ignored) {}
            }
            if (File::exists($destination)) {
                File::delete($destination);
            }
            return back()->with('error', 'Sao lưu thất bại. Kiểm tra log Laravel và cấu hình database.');
        } finally {
            if ($temporarySql && File::exists($temporarySql)) {
                File::delete($temporarySql);
            }
        }
    }

    private function exportMysqlToFile(string $path): void
    {
        $db = DB::connection();
        $handle = fopen($path, 'wb');
        if ($handle === false) {
            throw new \RuntimeException('Không thể tạo file SQL tạm.');
        }

        try {
            $this->writeAll($handle, "-- Portfolio MySQL Backup\nSET FOREIGN_KEY_CHECKS=0;\n\n");
            foreach ($db->select('SHOW FULL TABLES WHERE Table_type = ?', ['BASE TABLE']) as $table) {
                $tableName = array_values((array) $table)[0];
                $identifier = '`' . str_replace('`', '``', $tableName) . '`';
                $create = (array) $db->selectOne("SHOW CREATE TABLE {$identifier}");
                $ddl = $create['Create Table'] ?? null;
                if (!$ddl) {
                    throw new \RuntimeException('Không thể đọc cấu trúc bảng ' . $tableName);
                }
                $this->writeAll($handle, "DROP TABLE IF EXISTS {$identifier};\n{$ddl};\n\n");
                foreach ($db->table($tableName)->cursor() as $row) {
                    $values = [];
                    foreach ((array) $row as $value) {
                        if ($value === null) {
                            $values[] = 'NULL';
                        } elseif (is_resource($value)) {
                            $values[] = $db->getPdo()->quote(stream_get_contents($value));
                        } else {
                            $values[] = $db->getPdo()->quote((string) $value);
                        }
                    }
                    $this->writeAll($handle, "INSERT INTO {$identifier} VALUES (" . implode(', ', $values) . ");\n");
                }
                $this->writeAll($handle, "\n");
            }
            $this->writeAll($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
        } finally {
            fclose($handle);
        }
    }

    private function writeAll($handle, string $data): void
    {
        $length = strlen($data);
        $offset = 0;
        while ($offset < $length) {
            $written = fwrite($handle, substr($data, $offset));
            if ($written === false || $written === 0) {
                throw new \RuntimeException('Không thể ghi file SQL.');
            }
            $offset += $written;
        }
    }

    public function download(string $filename)
    {
        $path = $this->getBackupPath($filename);
        abort_unless(File::isFile($path), 404);
        return response()->download($path);
    }

    public function destroy(string $filename)
    {
        $path = $this->getBackupPath($filename);
        abort_unless(File::isFile($path), 404);
        abort_unless(File::delete($path), 500, 'Không thể xóa bản sao lưu.');
        return redirect()->route('admin.backups.index')->with('success', 'Đã xóa bản sao lưu.');
    }

    private function getBackupPath(string $filename): string
    {
        abort_unless((bool) preg_match('/^portfolio-[A-Za-z0-9_-]+\.zip$/D', $filename), 404);
        return $this->backupDirectory() . DIRECTORY_SEPARATOR . $filename;
    }
}
