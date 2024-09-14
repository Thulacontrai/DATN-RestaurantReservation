<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationCombosSeeder extends Seeder
{
    public function run()
    {
        DB::table('reservation_combos')->insert([
            ['id' => 1, 'reservation_id' => 12, 'combo_id' => 16, 'quantity' => 2, 'price' => 7250000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'reservation_id' => 17, 'combo_id' => 17, 'quantity' => 1, 'price' => 570000.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
