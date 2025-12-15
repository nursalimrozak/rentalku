<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;
use App\Models\Booking;

Schedule::call(function () {
    // Expire pending bookings older than 15 minutes
    // Exclude those that have pending/verified payments (proof uploaded but not checked)
    $expiredCount = Booking::where('status', 'pending_payment')
        ->where('created_at', '<', now()->subMinutes(15))
        ->whereDoesntHave('payments', function ($query) {
             $query->whereIn('status', ['pending', 'verified']);
        })
        ->update(['status' => 'cancelled']);

    if ($expiredCount > 0) {
        \Illuminate\Support\Facades\Log::info("Auto-cancelled {$expiredCount} unpaid bookings.");
    }
})->everyMinute();
