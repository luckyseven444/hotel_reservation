<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('customers')->insert([
            'name' => 'Robin Hood',
            'email' => 'robin@hood.com',
            'password' => Hash::make(123456789)
        ]);
    }
}
