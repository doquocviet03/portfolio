<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

// Giữ nguyên MySQL hiện tại
$mysql = DB::connection('mysql');

// File SQLite riêng, không ảnh hưởng MySQL
$sqlitePath = __DIR__ . '/database/export/portfolio.sqlite';

config([
    'database.connections.export_sqlite' => [
        'driver' => 'sqlite',
        'database' => $sqlitePath,
        'prefix' => '',
        'foreign_key_constraints' => true,
    ],
]);

$sqlite = DB::connection('export_sqlite');

// Tạo cấu trúc bảng bằng migrations
$sqlite->getPdo();

Artisan::call('migrate', [
    '--database' => 'export_sqlite',
    '--force' => true,
]);

echo Artisan::output();

$tables = ['projects', 'skills', 'experiences', 'contacts'];

foreach ($tables as $table) {
    if (!Schema::connection('mysql')->hasTable($table)) {
        echo "Bo qua {$table}: khong ton tai trong MySQL\n";
        continue;
    }

    if (!Schema::connection('export_sqlite')->hasTable($table)) {
        throw new RuntimeException("SQLite thieu bang {$table}");
    }

    $records = $mysql->table($table)->get();

    foreach ($records as $record) {
        $sqlite->table($table)->insert((array) $record);
    }

    echo "{$table}: da chuyen {$records->count()} ban ghi\n";
}

echo "HOAN TAT: {$sqlitePath}\n";
