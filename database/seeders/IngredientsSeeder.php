<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IngredientsSeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredients')->insert([
            [
                'id' => 1,
                'name' => 'oke',
                'supplier_id' => 1,
                'price' => 210000.00,
                'unit' => '32kg ( kilogram )',
                'ingredient_type_id' => 1,
                'created_at' => Carbon::parse('2024-09-10 10:39:44'),
                'updated_at' => Carbon::parse('2024-09-11 04:15:37'),
            ],
            [
                'id' => 2,
                'name' => 'oke',
                'supplier_id' => 1,
                'price' => 210000.00,
                'unit' => 'www',
                'ingredient_type_id' => 1,
                'created_at' => Carbon::parse('2024-09-10 10:39:44'),
                'updated_at' => Carbon::parse('2024-09-11 10:39:44'),
            ],
            [
                'id' => 4,
                'name' => 'ddd',
                'supplier_id' => 2,
                'price' => 22222.00,
                'unit' => '23',
                'ingredient_type_id' => 3,
                'created_at' => Carbon::parse('2024-09-11 03:51:27'),
                'updated_at' => Carbon::parse('2024-09-11 03:51:27'),
            ],
            [
                'id' => 5,
                'name' => 'ddd',
                'supplier_id' => 2,
                'price' => 22222.00,
                'unit' => 'kilogram',
                'ingredient_type_id' => 3,
                'created_at' => Carbon::parse('2024-09-11 03:51:47'),
                'updated_at' => Carbon::parse('2024-09-11 04:14:29'),
            ]
        ]);
    }
}
