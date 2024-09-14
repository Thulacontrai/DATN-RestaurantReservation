<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
                'id' => 6,
                'code' => 'SAVE10',
                'description' => 'Giảm giá 10% cho đơn hàng đầu tiên',
                'max_uses' => 100,
                'start_time' => Carbon::parse('2024-09-01 08:00:00'),
                'end_time' => Carbon::parse('2024-09-30 23:59:00'),
                'discount_type' => 'Percentage',
                'discount_amount' => 10.00,
                'created_at' => Carbon::parse('2024-09-07 11:47:56'),
                'updated_at' => Carbon::parse('2024-09-09 00:45:50'),
                'status' => 'active'
            ],
            [
                'id' => 7,
                'code' => 'FIXED50',
                'description' => 'Giảm giá cố định 50.000 VND',
                'max_uses' => 50,
                'start_time' => Carbon::parse('2024-09-05 08:00:00'),
                'end_time' => Carbon::parse('2024-09-20 23:59:59'),
                'discount_type' => 'Fixed',
                'discount_amount' => 50000.00,
                'created_at' => Carbon::parse('2024-09-07 11:47:56'),
                'updated_at' => Carbon::parse('2024-09-07 11:47:56'),
                'status' => 'inactive'
            ],
            [
                'id' => 8,
                'code' => 'DISCOUNT20',
                'description' => 'Giảm giá 20% cho đơn hàng trên 500.000 VND',
                'max_uses' => 200,
                'start_time' => Carbon::parse('2024-09-10 08:00:00'),
                'end_time' => Carbon::parse('2024-09-25 23:59:59'),
                'discount_type' => 'Percentage',
                'discount_amount' => 20.00,
                'created_at' => Carbon::parse('2024-09-07 11:47:56'),
                'updated_at' => Carbon::parse('2024-09-07 11:47:56'),
                'status' => 'active'
            ],
            [
                'id' => 9,
                'code' => 'EXPIRED50',
                'description' => 'Giảm 50% cho khách hàng VIP',
                'max_uses' => 10,
                'start_time' => Carbon::parse('2024-08-01 08:00:00'),
                'end_time' => Carbon::parse('2024-08-15 23:59:59'),
                'discount_type' => 'Percentage',
                'discount_amount' => 50.00,
                'created_at' => Carbon::parse('2024-09-07 11:47:56'),
                'updated_at' => Carbon::parse('2024-09-07 11:47:56'),
                'status' => 'expired'
            ],
            [
                'id' => 10,
                'code' => 'SAVE100',
                'description' => 'Giảm 100.000 VND cho đơn hàng trên 1.000.000 VND',
                'max_uses' => 300,
                'start_time' => Carbon::parse('2024-09-15 08:00:00'),
                'end_time' => Carbon::parse('2024-09-30 23:59:59'),
                'discount_type' => 'Fixed',
                'discount_amount' => 100000.00,
                'created_at' => Carbon::parse('2024-09-07 11:47:56'),
                'updated_at' => Carbon::parse('2024-09-07 11:47:56'),
                'status' => 'active'
            ],
        ]);
    }
}
