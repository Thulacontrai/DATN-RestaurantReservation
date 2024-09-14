<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('payments')->insert([
            ['id' => 3, 'reservation_id' => 14, 'bill_id' => 'BILL003', 'transaction_id' => 1003, 'transaction_amount' => 700000.00, 'refund_amount' => 100000.00, 'payment_method' => 'Online', 'status' => 'Completed', 'transaction_status' => 'completed', 'created_at' => Carbon::parse('2024-09-03 02:00:00'), 'updated_at' => Carbon::parse('2024-09-07 09:34:54')],
            ['id' => 4, 'reservation_id' => 1, 'bill_id' => 'BILL004', 'transaction_id' => 1004, 'transaction_amount' => 400000.00, 'refund_amount' => 50000.00, 'payment_method' => 'Cash', 'status' => 'Failed', 'transaction_status' => 'pending', 'created_at' => Carbon::parse('2024-09-04 07:00:00'), 'updated_at' => Carbon::parse('2024-09-07 09:35:05')],
            ['id' => 5, 'reservation_id' => 12, 'bill_id' => 'BILL005', 'transaction_id' => 1005, 'transaction_amount' => 600000.00, 'refund_amount' => 0.00, 'payment_method' => 'Credit Card', 'status' => 'Completed', 'transaction_status' => 'completed', 'created_at' => Carbon::parse('2024-09-05 06:00:00'), 'updated_at' => Carbon::parse('2024-09-05 07:00:00')],
            ['id' => 6, 'reservation_id' => 14, 'bill_id' => 'BILL006', 'transaction_id' => 1006, 'transaction_amount' => 200000.00, 'refund_amount' => 0.00, 'payment_method' => 'Cash', 'status' => 'Failed', 'transaction_status' => 'failed', 'created_at' => Carbon::parse('2024-09-06 05:00:00'), 'updated_at' => Carbon::parse('2024-09-06 05:30:00')],
        ]);
    }
}
