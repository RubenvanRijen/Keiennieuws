<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class adminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userOne =  User::create(
            [
                'firstname' => Str::random(10),
                'lastname' => Str::random(10),
                'postcode' => '5248LK',
                'house_number' => 5,
                'city' => 'oss',
                'street_name' => 'beukenlaan',
                'email' => 'hugegander2815@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]
        );
        $userOne->assignRole('admin');

        $subscriptionOne =  new Subscription();
        $subscriptionOne->endDate = Carbon::createFromDate(2200, 01, 01)->format('Y-m-d H:i:s');
        $subscriptionOne->user()->associate($userOne);
        $subscriptionOne->save();


        $userTwo  = User::create(
            [
                'firstname' => 'admin',
                'lastname' => 'boss',
                'postcode' => '5248LK',
                'house_number' => 5,
                'city' => 'oss',
                'street_name' => 'beukenlaan',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
        );
        $userTwo->assignRole('admin');

        $subscriptionTwo =  new Subscription();
        $subscriptionTwo->endDate = Carbon::createFromDate(2300, 01, 01)->format('Y-m-d H:i:s');
        $subscriptionTwo->user()->associate($userTwo);
        $subscriptionTwo->save();
    }
}
