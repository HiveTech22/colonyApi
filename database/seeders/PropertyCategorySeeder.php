<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyCategory;

class PropertyCategorySeeder extends Seeder
{
    public function run()
    {
        $type = collect([
            $this->createType(
                'Apartment',
            ),
            $this->createType(
                'Townhouses',
            ),
            $this->createType(
                'Villas',
            ),
            $this->createType(
                'Penthouses',
            ),
            $this->createType(
                'Hotel Apartments',
            ),
            $this->createType(
                'Residential Plot',
            ),
            $this->createType(
                'Residential Floor',
            ),
            $this->createType(
                'Residential Building',
            ),
            $this->createType(
                'Office Space',
            ),
            $this->createType(
                'Shop Space',
            ),
        ]);
    }

    private function createType(string $name, string $icon)
    {
        return PropertyCategory::factory()->create(compact('name', 'icon'));
    }
}