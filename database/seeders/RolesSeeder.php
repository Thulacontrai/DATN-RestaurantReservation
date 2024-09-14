<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'role_name' => 'Admin', 'description' => 'Quản trị viên có quyền toàn quyền quản lý hệ thống', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => 'Admin'],
            ['id' => 2, 'role_name' => 'Staff', 'description' => 'Người nhân viên có quyền cập nhật trạng thái', 'created_at' => Carbon::now(), 'updated_at' => Carbon::parse('2024-09-09 01:01:45'), 'name' => 'Editor'],
            ['id' => 4, 'role_name' => 'Manager', 'description' => 'Người quản lý có quyền quản lý nhân viên và xem báo cáo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => NULL],
            ['id' => 5, 'role_name' => 'Customer', 'description' => 'Khách hàng có quyền xem và mua sản phẩm', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => NULL],
            ['id' => 21, 'role_name' => 'Thu Ngân', 'description' => 'Bên nhà hàng', 'created_at' => Carbon::parse('2024-09-13 06:28:06'), 'updated_at' => Carbon::parse('2024-09-14 07:14:39'), 'name' => NULL],
        ]);
    }
}
