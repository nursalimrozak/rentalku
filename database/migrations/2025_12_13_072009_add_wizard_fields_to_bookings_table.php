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
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('rental_type', ['daily', 'weekly', 'monthly'])->default('daily')->after('car_id');
            $table->enum('service_type', ['self_pickup', 'delivery'])->default('self_pickup')->after('rental_type');
            $table->text('delivery_address')->nullable()->after('service_type');
            $table->integer('passengers')->default(1)->after('delivery_address');
            $table->foreignUuid('driver_id')->nullable()->constrained('drivers')->nullOnDelete()->after('use_driver');
            $table->integer('km_limit')->nullable()->after('driver_id');
            $table->decimal('excess_km_price', 15, 2)->default(0)->after('km_limit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
