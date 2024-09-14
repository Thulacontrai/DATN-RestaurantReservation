<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderCombosSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_combos')->insert([
            ['id' => 1, 'order_id' => 1, 'combo_id' => 16, 'quantity' => 2, 'price' => 500000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'order_id' => 71, 'combo_id' => 17, 'quantity' => 1, 'price' => 600000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'order_id' => 72, 'combo_id' => 18, 'quantity' => 3, 'price' => 700000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
