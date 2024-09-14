<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('reservations')->insert([
            [
                'id' => 1,
                'customer_id' => 3,
                'coupon_id' => 10,
                'reservation_time' => Carbon::parse('2024-09-07 14:31:00'),
                'guest_count' => 6,
                'deposit_amount' => 250000.00,
                'total_amount' => 400000.00,
                'remaining_amount' => 150000.00,
                'status' => 'Confirmed',
                'note' => 'Đặt bàn 6 người',
                'created_at' => Carbon::parse('2024-09-06 14:31:54'),
                'updated_at' => Carbon::parse('2024-09-08 06:03:32'),
            ],
            [
                'id' => 12,
                'customer_id' => 2,
                'coupon_id' => 7,
                'reservation_time' => Carbon::parse('2024-09-10 22:01:00'),
                'guest_count' => 12,
                'deposit_amount' => 222.00,
                'total_amount' => 843000.00,
                'remaining_amount' => 2221.00,
                'status' => 'Pending',
                'note' => 'oke',
                'created_at' => Carbon::parse('2024-09-07 08:10:29'),
                'updated_at' => Carbon::parse('2024-09-08 06:38:26'),
            ],
            [
                'id' => 14,
                'customer_id' => 4,
                'coupon_id' => 8,
                'reservation_time' => Carbon::parse('2024-09-16 22:38:00'),
                'guest_count' => 8,
                'deposit_amount' => 3444.00,
                'total_amount' => 786000.00,
                'remaining_amount' => 44.00,
                'status' => 'Cancelled',
                'cancelled_reason' => 'Tôi muốn đặt bàn 10 người trở lên',
                'note' => 'Tôi muốn đặt bàn 10 người trở lên',
                'created_at' => Carbon::parse('2024-09-07 08:38:54'),
                'updated_at' => Carbon::parse('2024-09-08 06:26:01'),
            ],
            [
                'id' => 17,
                'customer_id' => 6,
                'reservation_time' => Carbon::parse('2024-09-11 15:48:00'),
                'guest_count' => 6,
                'deposit_amount' => 222.00,
                'total_amount' => 400000.00,
                'remaining_amount' => 7.00,
                'status' => 'Confirmed',
                'note' => 'Good oke',
                'created_at' => Carbon::parse('2024-09-08 01:48:59'),
                'updated_at' => Carbon::parse('2024-09-11 11:38:27'),
            ],
        ]);
    }
}
