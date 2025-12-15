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
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('daily_rate');
            $table->decimal('in_city_rate', 15, 2)->default(0)->after('bio');
            $table->decimal('out_of_town_rate', 15, 2)->default(0)->after('in_city_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['in_city_rate', 'out_of_town_rate']);
            $table->decimal('daily_rate', 15, 2)->default(0)->after('bio');
        });
    }
};
