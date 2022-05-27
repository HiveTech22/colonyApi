<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ReviewSeeder extends Seeder
{
   
    public function run()
    {
        $users = User::all();
        $properties = Property::all();

        $properties->each(function ($property) use ($users) {
            Review::factory()
                ->count(2)
                ->state(new Sequence(
                    fn () => [
                        'author_id'         => $users->random()->id,
                        'property_id'    => $property->id(),
                    ],
                ))
                ->create();
        });
        
    }
}