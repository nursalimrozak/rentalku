<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try { DB::statement("ALTER TABLE vouchers DROP FOREIGN KEY vouchers_car_id_foreign"); } catch (\Throwable $e) { echo "FK drop error: " . $e->getMessage() . "\n"; }

$columns = ['uuid', 'description', 'start_date', 'end_date', 'quota', 'used_count', 'car_id', 'is_active'];
foreach ($columns as $column) {
    try {
        DB::statement("ALTER TABLE vouchers DROP COLUMN $column");
        echo "Dropped $column\n";
    } catch (\Throwable $e) {
        echo "Failed to drop $column: " . $e->getMessage() . "\n";
    }
}
