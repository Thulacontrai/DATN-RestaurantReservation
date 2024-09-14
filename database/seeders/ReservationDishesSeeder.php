<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationDishesSeeder extends Seeder
{
    public function run()
    {
        DB::table('reservation_dishes')->insert([
            ['id' => 1, 'reservation_id' => 12, 'dish_id' => 36, 'quantity' => 3, 'price' => 695000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'reservation_id' => 17, 'dish_id' => 37, 'quantity' => 2, 'price' => 600000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
