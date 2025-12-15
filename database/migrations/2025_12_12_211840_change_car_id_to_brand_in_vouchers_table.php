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
            // Drop foreign key and column safely
            try {
                $table->dropForeign(['car_id']); 
            } catch (\Exception $e) {}
            
            $table->dropColumn('car_id');
            $table->string('brand')->nullable()->after('used_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('brand');
            $table->foreignUuid('car_id')->nullable()->constrained('cars')->onDelete('set null')->after('used_count');
        });
    }
};
