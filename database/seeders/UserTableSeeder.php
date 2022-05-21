<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agent;
use App\Models\Vendor;
use App\Models\Writer;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'      => 'Shittu Oluwaseun',
            'email'     => 'shittuopeyemi24@gmail.com',
            'password'  => bcrypt('midshot17'),
            'image'  =>  'profile-photos/author-one.jpg',
            'type'  =>  User::ADMIN,
        ]);

        User::factory()->create([
            'name'      => 'Ojo Emmanuel',
            'email'     => 'ojotifeema@gmail.com',
            'password'  => bcrypt('password'),
            'image'  =>  'profile-photos/author-two.jpg',
            'type'  =>  User::DEFAULT,
        ]);
    }
}