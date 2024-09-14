<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeedbacksSeeder extends Seeder
{
    public function run()
    {
        DB::table('feedbacks')->insert([
            [
                'id' => 1,
                'reservation_id' => 12,
                'customer_id' => 3,
                'content' => 'no',
                'rating' => 1,
                'created_at' => Carbon::parse('2024-09-08 09:30:04'),
                'updated_at' => Carbon::parse('2024-09-09 09:30:04'),
            ],
            [
                'id' => 2,
                'reservation_id' => 17,
                'customer_id' => 2,
                'content' => 'lỗi',
                'rating' => 2,
                'created_at' => Carbon::parse('2024-09-08 09:30:04'),
                'updated_at' => Carbon::parse('2024-09-09 09:30:04'),
            ]
        ]);
    }
}
