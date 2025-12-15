<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use Carbon\Carbon;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'name' => 'Ahmad Wijaya',
                'phone_number' => '081234567890',
                'status' => 'available',
                'photo' => null, // You can add actual photo paths later
                'gender' => 'male',
                'date_of_birth' => Carbon::parse('1985-03-15'),
                'bio' => 'Experienced driver with over 15 years of professional driving. Specializes in long-distance trips and city tours. Known for punctuality and excellent customer service.',
                'daily_rate' => 150000,
                'rating' => 4.8,
                'experience_years' => 15,
                'sim' => null,
                'ktp' => null,
                'kk' => null,
            ],
            [
                'name' => 'Budi Santoso',
                'phone_number' => '081234567891',
                'status' => 'available',
                'photo' => null,
                'gender' => 'male',
                'date_of_birth' => Carbon::parse('1990-07-22'),
                'bio' => 'Professional driver with excellent knowledge of Jakarta and surrounding areas. Safe and reliable, with a clean driving record.',
                'daily_rate' => 120000,
                'rating' => 4.9,
                'experience_years' => 10,
                'sim' => null,
                'ktp' => null,
                'kk' => null,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'phone_number' => '081234567892',
                'status' => 'available',
                'photo' => null,
                'gender' => 'female',
                'date_of_birth' => Carbon::parse('1992-11-08'),
                'bio' => 'Female driver with 8 years of experience. Perfect for families and female passengers who prefer a female driver. Friendly and professional.',
                'daily_rate' => 130000,
                'rating' => 5.0,
                'experience_years' => 8,
                'sim' => null,
                'ktp' => null,
                'kk' => null,
            ],
            [
                'name' => 'Dedi Kurniawan',
                'phone_number' => '081234567893',
                'status' => 'busy',
                'photo' => null,
                'gender' => 'male',
                'date_of_birth' => Carbon::parse('1988-05-30'),
                'bio' => 'Experienced in both manual and automatic transmission. Great for business trips and airport transfers.',
                'daily_rate' => 140000,
                'rating' => 4.7,
                'experience_years' => 12,
                'sim' => null,
                'ktp' => null,
                'kk' => null,
            ],
            [
                'name' => 'Eko Prasetyo',
                'phone_number' => '081234567894',
                'status' => 'available',
                'photo' => null,
                'gender' => 'male',
                'date_of_birth' => Carbon::parse('1995-09-12'),
                'bio' => 'Young and energetic driver with modern driving skills. Familiar with GPS and navigation apps. Perfect for city tours.',
                'daily_rate' => 110000,
                'rating' => 4.6,
                'experience_years' => 6,
                'sim' => null,
                'ktp' => null,
                'kk' => null,
            ],
            [
                'name' => 'Fitri Handayani',
                'phone_number' => '081234567895',
                'status' => 'available',
                'photo' => null,
                'gender' => 'female',
                'date_of_birth' => Carbon::parse('1993-02-18'),
                'bio' => 'Experienced female driver specializing in family trips and shopping tours. Patient and careful driver.',
                'daily_rate' => 125000,
                'rating' => 4.9,
                'experience_years' => 7,
                'sim' => null,
                'ktp' => null,
                'kk' => null,
            ],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
