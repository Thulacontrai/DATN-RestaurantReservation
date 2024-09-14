<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderDishesSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_dishes')->insert([
            ['id' => 1, 'order_id' => 1, 'dish_id' => 36, 'quantity' => 2, 'price' => 695000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'order_id' => 71, 'dish_id' => 37, 'quantity' => 1, 'price' => 600000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'order_id' => 72, 'dish_id' => 38, 'quantity' => 3, 'price' => 872000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
