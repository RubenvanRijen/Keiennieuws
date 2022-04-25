<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            rolesSeeder::class,
            adminUserSeeder::class
        ]);
        for ($k = 0; $k < 10; $k++) {
            $user =  \App\Models\User::factory()->create();
            $user->assignRole('user');
        }
    }
}
