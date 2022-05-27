<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ReviewSeeder;
use Database\Seeders\BookingSeeder;
use Database\Seeders\PropertySeeder;
use Database\Seeders\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(BookingSeeder::class);
        // $this->call(ReviewSeeder::class);
    }
}