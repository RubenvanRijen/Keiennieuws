<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'firstname' => Str::random(10),
                'lastname' => Str::random(10),
                'postcode' => '5248LK',
                'house_number' => 5,
                'city' => 'oss',
                'street_name' => 'beukenlaan',
                'has_subscription' => true,
                'email' => 'hugegander2815@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]
        )->assignRole('admin');
        User::create(
            [
                'firstname' => 'admin',
                'lastname' => 'boss',
                'postcode' => '5248LK',
                'house_number' => 5,
                'city' => 'oss',
                'street_name' => 'beukenlaan',
                'has_subscription' => true,
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
        )->assignRole('admin');
    }
}
