<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'              => 'System Admin',
                'email'             => 'admin@gmail.com',
                'password'          => Hash::make('12345678'),
                'role'              => 'admin',
                'ban_status'        => 0,
                'number'            => 1700000000,
                'address'           => 'Narayangonj, Dhaka, Bangladesh',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name'              => 'Youth Customer',
                'email'             => 'user@gmail.com',
                'password'          => Hash::make('12345678'),
                'role'              => 'user',
                'ban_status'        => 0,
                'number'            => 1800000000,
                'address'           => 'Gulshan, Dhaka, Bangladesh',
                'email_verified_at' => now(),
            ]
        );
    }
}
