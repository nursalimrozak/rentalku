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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable()->after('email');
            
            // KTP Address
            $table->string('ktp_address')->nullable()->after('address'); // Street name
            $table->string('ktp_village')->nullable()->after('ktp_address');
            $table->string('ktp_district')->nullable()->after('ktp_village');
            $table->string('ktp_city')->nullable()->after('ktp_district');
            $table->string('ktp_province')->nullable()->after('ktp_city');
            $table->string('ktp_zip')->nullable()->after('ktp_province');

            // Domicile Address
            $table->string('dom_address')->nullable()->after('ktp_zip'); // Street name
            $table->string('dom_village')->nullable()->after('dom_address');
            $table->string('dom_district')->nullable()->after('dom_village');
            $table->string('dom_city')->nullable()->after('dom_district');
            $table->string('dom_province')->nullable()->after('dom_city');
            $table->string('dom_zip')->nullable()->after('dom_province');
        });

        // Update User Documents type enum
        // Since Laravel doesn't support changing ENUM values easily in migration without raw SQL or package
        DB::statement("ALTER TABLE user_documents MODIFY COLUMN type ENUM('ktp', 'sim', 'kk', 'akte', 'ijazah', 'employee_card', 'student_card', 'passport')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
