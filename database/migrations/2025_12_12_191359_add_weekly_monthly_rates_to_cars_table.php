<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('rental_rate_per_week', 15, 2)->nullable()->after('rental_rate_per_day');
            $table->decimal('rental_rate_per_month', 15, 2)->nullable()->after('rental_rate_per_week');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['rental_rate_per_week', 'rental_rate_per_month']);
        });
    }
};
