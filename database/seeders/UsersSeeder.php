<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 2,
                'name' => 'Hà Đăng Hoàng',
                'phone' => '02356565666',
                'address' => 'Nam Định',
                'email' => 'abc@gmail.com',
                'gender' => 'male',
                'date_of_birth' => '2004-01-10',
                'status' => 'active',
                'hire_date' => '2024-09-20',
                'position' => 'hahah',
                'created_at' => Carbon::parse('2024-09-07 02:27:13'),
                'updated_at' => Carbon::parse('2024-09-08 05:10:36'),
                'role_id' => 1,
                'avatar' => 'avatars/OW5ZoxH64zbFOcSbWoenWnGLN9z5hmPQF4NSyJz8.jpg',
                'password' => bcrypt('your_password_here')
            ],
            [
                'id' => 3,
                'name' => 'Hảo Hán',
                'phone' => '03245677',
                'address' => 'Viet Nam',
                'email' => 'abc123@gmail.com',
                'gender' => 'male',
                'date_of_birth' => '2024-09-11',
                'status' => 'active',
                'hire_date' => '2024-09-05',
                'position' => 'Vua',
                'created_at' => Carbon::parse('2024-09-07 02:35:04'),
                'updated_at' => Carbon::parse('2024-09-13 06:25:55'),
                'role_id' => 2,
                'avatar' => 'avatars/8xnsf08gZzwiYNv6ot7hw2OLIE6GX8aB1pU1AAsA.jpg',
                'password' => bcrypt('your_password_here')
            ],
            [
                'id' => 4,
                'name' => 'HDH',
                'phone' => '0123456',
                'address' => 'Hà Nội',
                'email' => 'u@gmial.com',
                'gender' => 'male',
                'date_of_birth' => '2024-09-21',
                'status' => 'active',
                'hire_date' => '2024-09-20',
                'position' => 'okt',
                'created_at' => Carbon::parse('2024-09-07 03:09:25'),
                'updated_at' => Carbon::parse('2024-09-11 12:15:07'),
                'role_id' => 5,
                'avatar' => 'avatars/6QlKhXyv8yIsaHHh0T7R8FMH88YA3QmOCY7zt346.jpg',
                'password' => bcrypt('your_password_here')
            ],
            [
                'id' => 6,
                'name' => 'Chính trị - Xã hội',
                'phone' => '01111111',
                'address' => 'Hà Nam',
                'email' => 'admin@gmail.com',
                'gender' => 'male',
                'date_of_birth' => '2024-09-18',
                'status' => 'active',
                'hire_date' => '2024-09-10',
                'position' => 'Vua',
                'created_at' => Carbon::parse('2024-09-08 05:13:47'),
                'updated_at' => Carbon::parse('2024-09-13 06:28:20'),
                'role_id' => 21,
                'avatar' => 'avatars/8o7tfksn1zF4W7s5USnOyPrlx2Z7Nbk0Tp9oPk09.jpg',
                'password' => bcrypt('your_password_here')
            ]
        ]);
    }
}
