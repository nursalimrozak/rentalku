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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('color')->nullable()->after('model');
            $table->string('car_type')->nullable()->after('brand');
        });

        // Modify enum columns to string to allow dynamic values
        DB::statement("ALTER TABLE cars MODIFY COLUMN transmission VARCHAR(255)");
        DB::statement("ALTER TABLE cars MODIFY COLUMN fuel_type VARCHAR(255)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['color', 'car_type']);
        });

        // Revert to enum (this might be risky if data exists that doesn't fit, but for dev rollback it's fine)
        DB::statement("ALTER TABLE cars MODIFY COLUMN transmission ENUM('manual', 'automatic')");
        DB::statement("ALTER TABLE cars MODIFY COLUMN fuel_type ENUM('petrol', 'diesel', 'electric', 'hybrid')");
    }
};
