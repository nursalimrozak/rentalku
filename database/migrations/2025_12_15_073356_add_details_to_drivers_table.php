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
            $table->string('photo')->nullable()->after('status');
            $table->enum('gender', ['male', 'female'])->nullable()->after('photo');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->text('bio')->nullable()->after('date_of_birth');
            $table->decimal('daily_rate', 15, 2)->default(0)->after('bio');
            $table->decimal('rating', 3, 2)->default(5.0)->after('daily_rate');
            $table->integer('experience_years')->default(0)->after('rating');
            $table->string('sim')->nullable()->after('experience_years'); // Driver's license path
            $table->string('ktp')->nullable()->after('sim'); // ID card path
            $table->string('kk')->nullable()->after('ktp'); // Family card path
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'photo', 
                'gender', 
                'date_of_birth', 
                'bio', 
                'daily_rate', 
                'rating', 
                'experience_years', 
                'sim', 
                'ktp', 
                'kk'
            ]);
        });
    }
};
