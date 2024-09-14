<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationHistorySeeder extends Seeder
{
    public function run()
    {
        DB::table('reservation_history')->insert([
            ['id' => 1, 'reservation_id' => 12, 'change_time' => Carbon::parse('2024-09-10 15:43:50'), 'status' => 'confirmed', 'note' => 'oke', 'created_at' => Carbon::parse('2024-09-09 14:36:13'), 'updated_at' => Carbon::parse('2024-09-10 15:43:50')],
            ['id' => 2, 'reservation_id' => 1, 'change_time' => Carbon::parse('2024-09-10 15:43:59'), 'status' => 'cancelled', 'note' => 'no', 'created_at' => Carbon::parse('2024-09-09 14:52:18'), 'updated_at' => Carbon::parse('2024-09-10 15:43:59')],
            ['id' => 3, 'reservation_id' => 17, 'change_time' => Carbon::parse('2024-09-10 15:44:07'), 'status' => 'pending', 'note' => 'one', 'created_at' => Carbon::parse('2024-09-10 14:54:50'), 'updated_at' => Carbon::parse('2024-09-10 15:44:07')],
            ['id' => 4, 'reservation_id' => 14, 'change_time' => Carbon::parse('2024-09-10 15:44:26'), 'status' => 'completed', 'note' => 'kok', 'created_at' => Carbon::parse('2024-09-11 14:55:36'), 'updated_at' => Carbon::parse('2024-09-10 15:44:26')],
        ]);
    }
}
