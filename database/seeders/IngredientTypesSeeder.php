<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IngredientTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredient_types')->insert([
            ['id' => 1, 'name' => 'Vegetables', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Fruits', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Dairy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'name' => 'Meat', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'name' => 'Seafood', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'name' => 'Grains', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'name' => 'Spices', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'name' => 'Beverages', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
