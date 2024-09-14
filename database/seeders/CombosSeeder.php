<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CombosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('combos')->insert([
            [
                'id' => 16,
                'name' => 'Combo đặc biệt',
                'description' => '<h2>&nbsp;</h2><p>GĐXH - Nếu bạn vẫn đang đau đầu suy nghĩ...</p>',
                'price' => 7250000.00,
                'image' => 'combo_images/u9aRDZBTSdO3zXxh5x8KlycclUdaaUXFi80p2u8s.jpg',
                'quantity_dishes' => 30,
                'created_at' => Carbon::parse('2024-09-08 05:48:46'),
                'updated_at' => Carbon::parse('2024-09-11 10:48:05')
            ],
            [
                'id' => 17,
                'name' => 'Combo Beefsteak kiểu Pháp',
                'description' => '<p>Vivu là một trong những quán lẩu bò Sài Gòn quen thuộc...</p>',
                'price' => 570000.00,
                'image' => 'combo_images/CWD8FXrmpRYaRargFOyLEJ22n9FJqCRNd9yTxHYK.jpg',
                'quantity_dishes' => 34,
                'created_at' => Carbon::parse('2024-09-08 05:56:23'),
                'updated_at' => Carbon::parse('2024-09-14 10:28:51')
            ],
            [
                'id' => 18,
                'name' => 'Combo Lẩu Nướng',
                'description' => '<p>Nếu là một fan chính hiệu của món nướng xứ Phù Tang...</p>',
                'price' => 1250000.00,
                'image' => 'combo_images/ukjnkn7waA3cmNsbHs0yp4743158n7rRLfLwiFB2.jpg',
                'quantity_dishes' => 17,
                'created_at' => Carbon::parse('2024-09-08 06:01:25'),
                'updated_at' => Carbon::parse('2024-09-08 06:01:25')
            ],
            [
                'id' => 19,
                'name' => 'Combo Beefsteak',
                'description' => '<h3><strong>Bò beefsteak kiểu Mỹ</strong></h3><p>Tuy không phải nơi xuất xứ...</p>',
                'price' => 3950000.00,
                'image' => 'combo_images/40HTkSA06Gdrr3o8w6Wr0dOFFVYIvyaTKeS7Mqs7.jpg',
                'quantity_dishes' => 34,
                'created_at' => Carbon::parse('2024-09-09 00:41:49'),
                'updated_at' => Carbon::parse('2024-09-09 00:42:46')
            ],
        ]);
    }
}
