<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuppliersSeeder extends Seeder
{
    public function run()
    {
        DB::table('suppliers')->insert([
            ['id' => 1, 'name' => 'Công ty TNHH Thực Phẩm Xanh', 'phone' => '0901234567', 'email' => 'info@thucphamxanh.vn', 'address' => '123 Đường A, Quận 1, TP.HCM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Công ty CP Thực Phẩm Sạch', 'phone' => '0912345678', 'email' => 'contact@thucphamsach.com', 'address' => '456 Đường B, Quận 7, TP.HCM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Công ty TNHH Thực Phẩm Việt', 'phone' => '0923456789', 'email' => 'support@thucphamviet.vn', 'address' => '789 Đường C, Quận 2, TP.HCM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'name' => 'Công ty CP Rau Củ Việt', 'phone' => '0934567890', 'email' => 'info@raucuviet.com', 'address' => '321 Đường D, Quận 3, TP.HCM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::parse('2024-09-10 11:06:15')],
            ['id' => 5, 'name' => 'Công ty TNHH Gia Vị Sạch', 'phone' => '0945678901', 'email' => 'contact@giavisach.vn', 'address' => '654 Đường E, Quận 10, TP.HCM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
