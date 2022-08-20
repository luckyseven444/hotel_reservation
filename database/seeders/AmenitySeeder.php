<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('amenities')->insert([
            'name' => 'Ac'
        ]);

        \DB::table('amenities')->insert([
            'name' => 'TV'
        ]);

        \DB::table('amenities')->insert([
            'name' => 'Fridge'
        ]);

        \DB::table('amenities')->insert([
            'name' => 'Wifi'
        ]);

        \DB::table('amenities')->insert([
            'name' => 'Breakfast'
        ]);

        \DB::table('amenities')->insert([
            'name' => 'Locker'
        ]);
    }
}
