<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@rentalku.com',
            'password' => Hash::make('password'), // password
            'role' => 'super_admin',
            'phone_number' => '081234567890',
            'address' => 'Kantor Pusat Rentalku',
            'is_verified' => true,
        ]);

        // Admin
        User::create([
            'name' => 'Admin Cabang',
            'email' => 'admin@rentalku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '081234567891',
            'address' => 'Kantor Cabang Rentalku',
            'is_verified' => true,
        ]);

        // Penyewa (Test User)
        User::create([
            'name' => 'Penyewa Test',
            'email' => 'user@rentalku.com',
            'password' => Hash::make('password'),
            'role' => 'penyewa',
            'phone_number' => '081234567892',
            'address' => 'Jl. Penyewa No. 1',
            'is_verified' => false,
        ]);
    }
}
