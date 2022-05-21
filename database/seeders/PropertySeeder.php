<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    
    public function run()
    {
        $property = collect([
            $this->createProperty(
                'Ondo road house for rent',
                'ondo-road-house-for-rent',
                35000,
                now(),
                1,
                1,
                'for-rent',
                '10, aboderin street orita challenge',
                '7.0833',
                '4.8333',
                'yearly',
                'Do you need help moving to your new home? Our logistics department has got you covered. <br>
                            You Interact with our e-commerce & points platform, Earn points as you search,
                            order and make bookings for items available',
                'properties/p-1.png',
                'properties/p-2.png',
                'properties/p-3.png',
                'properties/pv-1.mp4',
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                2
            ),
            $this->createProperty(
                'lipakala furnished apartment',
                'lipakala-funished-apartment',
                54000,
                now(),
                1,
                1,
                'for-rent',
                '10, ayetoro street esso',
                '7.0833',
                '4.8333',
                'yearly',
                'Do you need help moving to your new home? Our logistics department has got you covered.
                            You Interact with our e-commerce & points platform, Earn points as you search,
                            order and make bookings for items available',
                'properties/p-3.png',
                'properties/p-2.png',
                'properties/p-3.png',
                'properties/pv-1.mp4',
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
            ),
        ]); 
    }

    private function createProperty(
        string $title,
        string $slug,
        int $price,
        string $built,
        string $bedroom,
        string $bathroom,
        string $purpose,
        string $address,
        string $latitude,
        string $longitude,
        string $frequency,
        string $description,
        string $image,
        string $image2,
        string $image3,
        string $video,
        int $fence,
        int $pool,
        int $wifi,
        int $park,
        int $conditioning,
        int $tiles,
        int $furnish,
        int $laundry,
        int $isAvailable,
        int $isVerified,
        int $author_id
    ) {
        return Property::factory()->create(compact(
            'title',
            'slug',
            'price',
            'built',
            'bedroom',
            'bathroom',
            'purpose',
            'address',
            'latitude',
            'longitude',
            'frequency',
            'description',
            'image',
            'image2',
            'image3',
            'video',
            'fence',
            'pool',
            'wifi',
            'park',
            'conditioning',
            'tiles',
            'furnish',
            'laundry',
            'isAvailable',
            'isVerified',
            'author_id',
        ));
    }
}