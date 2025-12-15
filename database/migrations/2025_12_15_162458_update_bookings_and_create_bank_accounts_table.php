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
        // Create Bank Accounts Table
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_holder');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Update Bookings Table
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('payment_type', ['full_payment', 'down_payment'])->default('full_payment')->after('status');
        });

        // Update Status Enum to include 'dp_50'
        // Using raw SQL for Enum modification as it is most reliable for MySQL/MariaDB without Doctrine
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending_payment', 'confirmed', 'ongoing', 'completed', 'cancelled', 'refund_pending', 'refunded', 'payment_failed', 'dp_50') DEFAULT 'pending_payment'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });

        // Revert Status Enum
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending_payment', 'confirmed', 'ongoing', 'completed', 'cancelled', 'refund_pending', 'refunded', 'payment_failed') DEFAULT 'pending_payment'");
    }
};
