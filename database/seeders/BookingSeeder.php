<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run()
    {
        Booking::factory()->count(1)->create(['author_id' => 1, 'property_uuid' => 1]);
        Booking::factory()->count(1)->create(['author_id' => 2, 'property_uuid' => 2]);
    }
}