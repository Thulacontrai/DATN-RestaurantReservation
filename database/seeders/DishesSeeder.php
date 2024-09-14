<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dishes')->insert([
            [
                'id' => 36,
                'category_id' => 1,
                'name' => 'Bò beefsteak kiểu Mỹ',
                'price' => 695000.00,
                'quantity' => 20,
                'image' => 'dish_images/tIKZyy71ZCRJ747zAWFuLeTIFvkqS6Ejkc1g6Bel.png',
                'status' => 'available',
                'created_at' => Carbon::parse('2024-09-07 06:47:32'),
                'updated_at' => Carbon::parse('2024-09-09 00:27:00')
            ],
            [
                'id' => 37,
                'category_id' => 1,
                'name' => 'Bò Beefsteak kiểu Pháp',
                'price' => 600000.00,
                'quantity' => 15,
                'image' => 'dish_images/P9L2sU7aw0crGdDDdK9TqLBpDNzneMF9SvmtQu6U.png',
                'status' => 'reserved',
                'created_at' => Carbon::parse('2024-09-07 06:47:32'),
                'updated_at' => Carbon::parse('2024-09-09 00:26:01')
            ],
            [
                'id' => 38,
                'category_id' => 1,
                'name' => 'Bò Beefsteak kiểu Úc',
                'price' => 872000.00,
                'quantity' => 7,
                'image' => 'dish_images/OkqVTDIzkpzsKabxdqRJDRuvMpoQzwpgqqN5WXxb.jpg',
                'status' => 'in_use',
                'created_at' => Carbon::parse('2024-09-07 06:47:32'),
                'updated_at' => Carbon::parse('2024-09-14 01:07:47')
            ],
            [
                'id' => 40,
                'category_id' => 1,
                'name' => 'Bò beefsteak - Mì Ý Spaghetti',
                'price' => 535000.00,
                'quantity' => 47,
                'image' => 'dish_images/Gyn4K3XJITftV5qYwPUdj5v5vfIhTaIeleoPrnhS.jpg',
                'status' => 'reserved',
                'created_at' => Carbon::parse('2024-09-13 19:52:22'),
                'updated_at' => Carbon::parse('2024-09-13 19:52:22')
            ],
            [
                'id' => 41,
                'category_id' => 1,
                'name' => 'Beef-steak Sườn Tomahawk Steak',
                'price' => 832000.00,
                'quantity' => 34,
                'image' => 'dish_images/wgL1aiOdYvwMV8yweMug3O5znRFK83yee13mNBor.jpg',
                'status' => 'available',
                'created_at' => Carbon::parse('2024-09-13 20:18:12'),
                'updated_at' => Carbon::parse('2024-09-14 01:08:59')
            ],
            // Thêm các mục khác tương tự
        ]);
    }
}
