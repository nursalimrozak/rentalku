<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'color',
        'car_type',
        'year',
        'license_plate',
        'transmission',
        'fuel_type',
        'seating_capacity',
        'rental_rate_per_day',
        'rental_rate_per_week',
        'rental_rate_per_month',
        'driver_fee_in_city',
        'driver_fee_out_town',
        'max_km_in_city',
        'max_km_out_town',
        'penalty_per_km',
        'photo',
        'status',
        'is_featured',
        'description',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function isAvailable($startDate, $endDate)
    {
        return !$this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($startDate, $endDate) {
                // Check overlap: Existing Start < Requested End AND Existing End (+30min) > Requested Start
                $query->where('start_date', '<', $endDate)
                      ->whereRaw('DATE_ADD(end_date, INTERVAL 30 MINUTE) > ?', [$startDate]);
            })
            ->exists();
    }
}
