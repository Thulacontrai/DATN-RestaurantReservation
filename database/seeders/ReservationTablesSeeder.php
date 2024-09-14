<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationTablesSeeder extends Seeder
{
    public function run()
    {
        DB::table('reservation_tables')->insert([
            ['table_id' => 1, 'reservation_id' => 12, 'status' => 'available', 'start_time' => '25:36:45', 'end_time' => '37:36:44', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_id' => 2, 'reservation_id' => 12, 'status' => 'reserved', 'start_time' => '10:22:38', 'end_time' => '20:30:38', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_id' => 3, 'reservation_id' => 14, 'status' => 'occupied', 'start_time' => '07:30:27', 'end_time' => '17:00:27', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_id' => 4, 'reservation_id' => 17, 'status' => 'cleaning', 'start_time' => '15:33:05', 'end_time' => '21:00:01', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
