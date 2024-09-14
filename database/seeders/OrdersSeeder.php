<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'reservation_id' => 12,
                'staff_id' => 6,
                'table_id' => 4,
                'customer_id' => 12,
                'total_amount' => 222.00,
                'order_type' => 'dine_in',
                'status' => 'Completed',
                'discount_amount' => 11.00,
                'final_amount' => 222222.00,
                'created_at' => Carbon::parse('2024-09-06 17:18:16'),
                'updated_at' => Carbon::parse('2024-09-09 00:50:19'),
            ],
            [
                'id' => 71,
                'reservation_id' => 14,
                'staff_id' => 4,
                'table_id' => 5,
                'customer_id' => 12,
                'total_amount' => 33333.00,
                'order_type' => 'take_away',
                'status' => 'Pending',
                'discount_amount' => 1230.00,
                'final_amount' => 222222.00,
                'created_at' => Carbon::parse('2024-09-06 17:18:16'),
                'updated_at' => Carbon::parse('2024-09-08 03:59:45'),
            ],
            [
                'id' => 72,
                'reservation_id' => 1,
                'staff_id' => 4,
                'table_id' => 2,
                'customer_id' => 23,
                'total_amount' => 33333.00,
                'order_type' => 'take_away',
                'status' => 'Cancelled',
                'discount_amount' => 3222.00,
                'final_amount' => 43222.00,
                'created_at' => Carbon::parse('2024-09-06 17:18:16'),
                'updated_at' => Carbon::parse('2024-09-08 03:59:45'),
            ],
            [
                'id' => 73,
                'reservation_id' => 17,
                'staff_id' => 2,
                'table_id' => 4,
                'customer_id' => 23,
                'total_amount' => 33333.00,
                'order_type' => 'delivery',
                'status' => 'Completed',
                'discount_amount' => 3222.00,
                'final_amount' => 43222.00,
                'created_at' => Carbon::parse('2024-09-06 17:18:16'),
                'updated_at' => Carbon::parse('2024-09-11 11:35:48'),
            ]
        ]);
    }
}
