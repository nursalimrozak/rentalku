<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Using raw SQL to modify ENUM column as Doctrine DBAL has issues with ENUMs sometimes
        DB::statement("ALTER TABLE payments MODIFY COLUMN type ENUM('down_payment', 'full_payment', 'penalty_payment', 'repayment') DEFAULT 'full_payment'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE payments MODIFY COLUMN type ENUM('down_payment', 'full_payment', 'penalty_payment') DEFAULT 'full_payment'");
    }
};
