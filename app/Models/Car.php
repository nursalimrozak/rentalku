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

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function isAvailable($startDate, $endDate)
    {
        // Check for overlapping bookings (excluding cancelled)
        $hasBookingConflict = $this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($startDate, $endDate) {
                // Check overlap: Existing Start < Requested End AND Existing End (+30min) > Requested Start
                $query->where('start_date', '<', $endDate)
                      ->whereRaw('DATE_ADD(end_date, INTERVAL 30 MINUTE) > ?', [$startDate]);
            })
            ->exists();

        // Check for overlapping maintenance (scheduled or ongoing only)
        $hasMaintenanceConflict = $this->maintenances()
            ->whereIn('status', ['scheduled', 'ongoing'])
            ->where(function ($query) use ($startDate, $endDate) {
                // Check overlap with maintenance period
                $query->where(function ($q) use ($startDate, $endDate) {
                    // Case 1: Maintenance has end_date - check normal overlap
                    // Overlap if: maintenance_start < requested_end AND maintenance_end > requested_start
                    $q->whereNotNull('end_date')
                      ->where('date', '<', $endDate)
                      ->where('end_date', '>', $startDate);
                })->orWhere(function ($q) use ($endDate) {
                    // Case 2: Maintenance has no end_date - treat as ongoing indefinitely
                    // Block if maintenance start is before or during requested period
                    $q->whereNull('end_date')
                      ->where('date', '<=', $endDate);
                });
            })
            ->exists();

        return !$hasBookingConflict && !$hasMaintenanceConflict;
    }

    public function getAvailabilityStatus($startDate, $endDate)
    {
        // 1. Check Maintenance First (Maintenance overrides bookings generally, or should we say if under maintenance it's definitely maintenance)
        $hasMaintenanceConflict = $this->maintenances()
            ->whereIn('status', ['scheduled', 'ongoing'])
            ->where(function ($query) use ($startDate, $endDate) {
                 $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereNotNull('end_date')
                      ->where('date', '<', $endDate)
                      ->where('end_date', '>', $startDate);
                })->orWhere(function ($q) use ($endDate) {
                    $q->whereNull('end_date')
                      ->where('date', '<=', $endDate);
                });
            })
            ->exists();

        if ($hasMaintenanceConflict) {
            return 'maintenance';
        }

        // 2. Check Bookings
        $hasBookingConflict = $this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($startDate, $endDate) {
                // Check overlap: Existing Start < Requested End AND Existing End (+30min) > Requested Start
                $query->where('start_date', '<', $endDate)
                      ->whereRaw('DATE_ADD(end_date, INTERVAL 30 MINUTE) > ?', [$startDate]);
            })
            ->exists();

        if ($hasBookingConflict) {
            return 'booked';
        }

        return 'available';
    }
}
