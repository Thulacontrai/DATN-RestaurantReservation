<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TablesSeeder extends Seeder
{
    public function run()
    {
        DB::table('tables')->insert([
            ['id' => 2, 'area' => 'Tầng 1', 'table_number' => 1, 'table_type' => 'VIP', 'status' => 'Reserved', 'created_at' => Carbon::parse('2024-09-06 05:02:47'), 'updated_at' => Carbon::parse('2024-09-14 04:30:58'), 'deleted_at' => NULL],
            ['id' => 4, 'area' => 'Tầng 1', 'table_number' => 2, 'table_type' => 'Thường', 'status' => 'Available', 'created_at' => Carbon::parse('2024-09-06 05:06:54'), 'updated_at' => Carbon::parse('2024-09-14 04:31:05'), 'deleted_at' => NULL],
            ['id' => 5, 'area' => 'Tầng 1', 'table_number' => 3, 'table_type' => 'VIP', 'status' => 'Reserved', 'created_at' => Carbon::parse('2024-09-06 05:08:50'), 'updated_at' => Carbon::parse('2024-09-14 04:31:12'), 'deleted_at' => NULL],
            ['id' => 8, 'area' => 'Tầng 1', 'table_number' => 4, 'table_type' => 'Thường', 'status' => 'Occupied', 'created_at' => Carbon::parse('2024-09-08 05:07:10'), 'updated_at' => Carbon::parse('2024-09-14 04:44:23'), 'deleted_at' => NULL],
            ['id' => 10, 'area' => 'Tầng 1', 'table_number' => 5, 'table_type' => 'Thường', 'status' => 'Available', 'created_at' => Carbon::parse('2024-09-14 04:31:28'), 'updated_at' => Carbon::parse('2024-09-14 04:31:28'), 'deleted_at' => NULL],
            ['id' => 11, 'area' => 'Tầng 1', 'table_number' => 6, 'table_type' => 'VIP', 'status' => 'Available', 'created_at' => Carbon::parse('2024-09-14 04:31:32'), 'updated_at' => Carbon::parse('2024-09-14 04:35:10'), 'deleted_at' => NULL],
            // Thêm các bản ghi khác tương tự
        ]);
    }
}
