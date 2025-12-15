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
        // 1. Vouchers Table
        Schema::create('vouchers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent']);
            $table->decimal('value', 15, 2);
            $table->decimal('minimum_spend', 15, 2)->default(0);
            $table->date('valid_until')->nullable();
            $table->timestamps();
        });

        // 2. Cars Table
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->string('license_plate')->unique();
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid']);
            $table->integer('seating_capacity');
            $table->decimal('rental_rate_per_day', 15, 2);
            $table->decimal('driver_fee_in_city', 15, 2)->default(150000);
            $table->decimal('driver_fee_out_town', 15, 2)->default(250000);
            $table->integer('max_km_in_city')->nullable();
            $table->integer('max_km_out_town')->nullable();
            $table->decimal('penalty_per_km', 15, 2)->default(0);
            $table->string('photo');
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 3. User Documents Table
        Schema::create('user_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['ktp', 'sim', 'kk', 'akte', 'ijazah']);
            $table->string('file_path');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        // 4. Bookings Table
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('car_id')->constrained('cars')->onDelete('cascade');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('total_days');
            $table->boolean('use_driver')->default(false);
            $table->decimal('driver_fee', 15, 2)->default(0); // Snapshot of fee
            $table->enum('destination_type', ['in_city', 'out_town'])->default('in_city');
            $table->decimal('total_price', 15, 2);
            $table->enum('status', [
                'pending_payment', 
                'confirmed', 
                'ongoing', 
                'completed', 
                'cancelled', 
                'refund_pending', 
                'refunded', 
                'payment_failed'
            ])->default('pending_payment');
            $table->text('cancellation_reason')->nullable();
            $table->decimal('refund_amount', 15, 2)->nullable();
            
            // Mileage & Penalty Logic
            $table->integer('start_km')->nullable();
            $table->integer('end_km')->nullable();
            $table->decimal('damage_fee', 15, 2)->default(0);
            $table->text('damage_notes')->nullable();
            $table->decimal('overdue_fee', 15, 2)->default(0);
            // 'total_penalty' can be calculated dynamically or stored. Storing for simplicity in payment logic.
            $table->decimal('total_penalty', 15, 2)->default(0); 
            $table->enum('penalty_status', ['no_penalty', 'pending', 'paid', 'verified'])->default('no_penalty');

            // Voucher Logic
            $table->string('voucher_code')->nullable();
            $table->decimal('voucher_discount', 15, 2)->default(0);
            
            $table->timestamps();
        });

        // 5. Payments Table
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->enum('payment_method', ['bank_transfer'])->default('bank_transfer');
            $table->enum('type', ['down_payment', 'full_payment', 'penalty_payment'])->default('full_payment');
            $table->string('proof_file_path');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('user_documents');
        Schema::dropIfExists('cars');
        Schema::dropIfExists('vouchers');
    }
};
