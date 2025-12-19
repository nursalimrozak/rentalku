<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'nursalimrozak@twinbrotherstudio.com'],
            [
                'name' => 'Nursalim Rozak',
                'password' => Hash::make('JandaMuda'),
                'role' => 'admin',
                'is_verified' => true,
            ]
        );
    }
}
