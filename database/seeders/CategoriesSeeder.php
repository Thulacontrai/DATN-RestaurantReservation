<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Món ăn',
                'description' => 'Các món ăn chính cho thực đơn',
                'created_at' => Carbon::parse('2024-09-06 12:41:27'),
                'updated_at' => Carbon::parse('2024-09-12 09:14:25')
            ],
            [
                'id' => 2,
                'name' => 'Đồ uống',
                'description' => 'Các loại đồ uống như trà, nước ngọt và cà phê',
                'created_at' => Carbon::parse('2024-09-06 12:41:27'),
                'updated_at' => Carbon::parse('2024-09-06 12:41:27')
            ],
            [
                'id' => 3,
                'name' => 'Tráng miệng',
                'description' => 'Các loại món tráng miệng đi kèm',
                'created_at' => Carbon::parse('2024-09-06 12:41:27'),
                'updated_at' => Carbon::parse('2024-09-14 07:13:44')
            ],
        ]);
    }
}
