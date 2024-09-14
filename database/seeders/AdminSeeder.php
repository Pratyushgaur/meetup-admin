<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' =>'Admin',
            'mobile' =>'9999999999',
            'country_code' => "+91",
            'gender' => 'male',
            'email' =>'admin@gmail.com',
            'password' => 123456,
            'profile_image' => 'image'
        ]);
    }
}
