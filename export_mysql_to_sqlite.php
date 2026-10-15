<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$mysql = DB::connection('mysql');

$directory = __DIR__ . '/database/export';
$sqlitePath = $directory . '/portfolio.sqlite';

if (!is_dir($directory)) {
    mkdir($directory, 0775, true);
}

// Không ghi đè file SQLite đang có.
// Tạo bản sao lưu trước khi xuất.
if (file_exists($sqlitePath)) {
    $backupPath = $directory . '/portfolio-backup-' .
        date('Ymd-His') . '.sqlite';

    if (!copy($sqlitePath, $backupPath)) {
        throw new RuntimeException('Khong sao luu duoc SQLite');
    }

    echo "Da sao luu: {$backupPath}\n";

    // Chỉ xóa file xuất trên máy sau khi sao lưu.
    if (!unlink($sqlitePath)) {
        throw new RuntimeException('Khong the tao lai SQLite');
    }
}

// Tạo file SQLite trống
touch($sqlitePath);

config([
    'database.connections.export_sqlite' => [
        'driver' => 'sqlite',
        'database' => $sqlitePath,
        'prefix' => '',
        'foreign_key_constraints' => true,
    ],
]);

$sqlite = DB::connection('export_sqlite');

// Tạo toàn bộ bảng từ migration hiện tại
Artisan::call('migrate', [
    '--database' => 'export_sqlite',
    '--force' => true,
]);

echo Artisan::output();

// Những bảng cần chuyển dữ liệu
$tables = [
    'users',
    'profiles',
    'projects',
    'skills',
    'experiences',
    'contacts',
];

foreach ($tables as $table) {

    if (!Schema::connection('mysql')->hasTable($table)) {
        echo "Bo qua {$table}: khong co trong MySQL\n";
        continue;
    }

    if (!Schema::connection('export_sqlite')->hasTable($table)) {
        throw new RuntimeException(
            "SQLite thieu bang {$table}. Kiem tra migrations."
        );
    }

    $records = $mysql->table($table)->get();

    $sqlite->transaction(function () use ($sqlite, $table, $records) {
        foreach ($records as $record) {
            $sqlite->table($table)->insert((array) $record);
        }
    });

    echo "{$table}: {$records->count()} ban ghi\n";
}

echo "\nXUAT SQLITE THANH CONG\n";
echo "File: {$sqlitePath}\n";
