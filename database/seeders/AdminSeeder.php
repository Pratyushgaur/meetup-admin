<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' =>'Admin',
            'mobile' =>'9999999999',
            'country_code' => "+91",
            'gender' => 'male',
            'email' =>'admin@gmail.com',
            'password' =>\Hash::make('admin@123'),
            'role' => '0'
        ]);
    }
}
