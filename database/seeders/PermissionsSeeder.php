<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            ['id' => 1, 'permission_name' => 'view_users', 'description' => 'Quyền xem danh sách người dùng', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'permission_name' => 'edit_users', 'description' => 'Quyền chỉnh sửa thông tin người dùng', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'permission_name' => 'delete_users', 'description' => 'Quyền xóa người dùng', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'permission_name' => 'view_orders', 'description' => 'Quyền xem danh sách đơn hàng', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'permission_name' => 'edit_orders', 'description' => 'Quyền chỉnh sửa đơn hàng', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'permission_name' => 'delete_orders', 'description' => 'Quyền xóa đơn hàng', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
