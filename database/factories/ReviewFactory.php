<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    
    public function definition()
    {
        return [
            'message'              => $this->faker->text(),
            'rating'               => rand(1, 5),
            'property_uuid'           => Property::factory(),
            'author_id'            => User::factory(),
        ];
    }
}