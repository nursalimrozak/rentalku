<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_days',
        'use_driver',
        'driver_fee',
        'destination_type',
        'total_price',
        'status',
        'cancellation_reason',
        'refund_amount',
        'start_km',
        'end_km',
        'damage_fee',
        'damage_notes',
        'overdue_fee',
        'total_penalty',
        'penalty_status',
        'voucher_code',
        'voucher_discount',
        'rental_type',
        'service_type',
        'delivery_address',
        'passengers',
        'driver_id',
        'km_limit',
        'excess_km_price',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'use_driver' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
