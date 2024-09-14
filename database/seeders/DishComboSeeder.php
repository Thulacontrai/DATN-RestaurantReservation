<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Combo;
use App\Models\Dishes;

class DishComboSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Appetizers',
            'description' => 'Light starters to begin your meal.',
        ]);

        Dishes::create([
            'name' => 'Chicken Caesar Salad',
            'description' => 'Grilled chicken with Caesar dressing.',
            'price' => 100000,
            'image' => 'chicken_salad.jpg',
        ]);

        Combo::create([
            'name' => 'Family Meal',
            'description' => 'A meal for the whole family.',
            'price' => 300000,
            'image' => 'family_meal.jpg',
        ]);
    }
}
