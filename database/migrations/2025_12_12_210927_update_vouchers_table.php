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
        Schema::table('vouchers', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->unique();
            $table->string('description')->nullable()->after('code');
            $table->dateTime('start_date')->nullable()->after('minimum_spend');
            $table->dateTime('end_date')->nullable()->after('start_date');
            $table->integer('quota')->default(0)->after('end_date');
            $table->integer('used_count')->default(0)->after('quota');
            $table->foreignUuid('car_id')->nullable()->constrained('cars')->onDelete('set null')->after('used_count');
            $table->boolean('is_active')->default(true)->after('car_id');
            $table->dropColumn('valid_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
