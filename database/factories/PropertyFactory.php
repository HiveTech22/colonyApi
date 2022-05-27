<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();

        return [
            'title'                 => $title,
            'slug'                  => Str::slug($title . '-' . now()->getPreciseTimestamp(4)),
            'price'                 => $this->faker->numberBetween($min = 35000, $max = 150000),
            'built'                 => now(),
            'bedroom'               => rand(1, 5),
            'bathroom'              => rand(1, 5),
            'purpose'               => $this->faker->randomElement(['for-sale', 'for-rent']),
            'address'               =>  $this->faker->city(),
            'latitude'              =>  '7.0833',
            'longitude'             =>  '4.8333',
            'image'                 => 'properties/p-' . rand(1, 12) . '.png',
            'image2'                => 'properties/p-' . rand(1, 12) . '.png',
            'image3'                => 'properties/p-' . rand(1, 12) . '.png',
            'video'                 => null,
            'frequency'             => $this->faker->randomElement(['monthly', 'yearly']),
            'description'           =>  $this->faker->paragraph(5),
            'furnish'           => rand(0, 1),
            'fence'              => rand(0, 1),
            'wifi'              => rand(0, 1),
            'pool'              => rand(0, 1),
            'conditioning'      => rand(0, 1),
            'tiles'                 => rand(0, 1),
            'laundry'                   => rand(0, 1),
            'isAvailable'           => rand(0, 1),
            'isVerified'            => rand(0, 1),
            'author_id'               => $attribute['author_id'] ?? User::factory(),
        ];
    }
}