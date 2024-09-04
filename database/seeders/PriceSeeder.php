<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Price;
class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Price::insert(
            [
                [
                    'prices' => '10',
                ],
                [
                    'prices' => '20',
                ],
                [
                    'prices' => '30',
                ],
                [
                    'prices' => '40',
                ],
                [
                    'prices' => '50',
                ],
                [
                    'prices' => '60',
                ],
                [
                    'prices' => '70',
                ],
                [
                    'prices' => '80',
                ],
                [
                    'prices' => '90',
                ],
                [
                    'prices' => '100',
                ]
            ]
        );

    }
}
