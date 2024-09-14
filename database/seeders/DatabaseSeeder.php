<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriesSeeder::class,
            CombosSeeder::class,
            DishesSeeder::class,
            FeedbacksSeeder::class,
            IngredientsSeeder::class,
            IngredientTypesSeeder::class,
            OrderCombosSeeder::class,
            MigrationsSeeder::class,
            OrderDishesSeeder::class,
            PaymentsSeeder::class,
            PermissionsSeeder::class,
            PersonalAccessTokensSeeder::class,
            ReservationsSeeder::class,
            ReservationCombosSeeder::class,
            ReservationDishesSeeder::class,
            ReservationHistorySeeder::class,
            ReservationTablesSeeder::class,
            RolesSeeder::class,
            RolePermissionsSeeder::class,
            SuppliersSeeder::class,
            TablesSeeder::class,
            UsersSeeder::class,

        ]);

    }
}
