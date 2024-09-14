<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('migrations')->insert([
            ['id' => 1, 'migration' => '2014_10_12_000000_create_users_table', 'batch' => 1],
            ['id' => 2, 'migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 1],
            ['id' => 3, 'migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 1],
            ['id' => 4, 'migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 1],
            ['id' => 5, 'migration' => '2024_09_06_084947_create_tables_table', 'batch' => 1],
            ['id' => 6, 'migration' => '2024_09_06_091918_create_roles_table', 'batch' => 1],
            ['id' => 8, 'migration' => '2024_09_06_092719_create_coupons_table', 'batch' => 2],
            ['id' => 9, 'migration' => '2024_09_06_092800_create_reservations_table', 'batch' => 3],
            ['id' => 10, 'migration' => '2024_09_06_093051_create_reservation_tables_table', 'batch' => 4],
            ['id' => 11, 'migration' => '2024_09_06_093141_create_orders_table', 'batch' => 5],
            ['id' => 12, 'migration' => '2024_09_06_093516_create_combos_table', 'batch' => 6],
            ['id' => 13, 'migration' => '2024_09_06_093539_create_reservation_combos_table', 'batch' => 7],
            ['id' => 14, 'migration' => '2024_09_06_093839_create_categories_table', 'batch' => 8],
            ['id' => 15, 'migration' => '2024_09_06_093855_create_dishes_table', 'batch' => 9],
            ['id' => 16, 'migration' => '2024_09_06_093936_create_reservation_dishes_table', 'batch' => 10],
            ['id' => 17, 'migration' => '2024_09_06_094026_create_feedbacks_table', 'batch' => 11],
            ['id' => 18, 'migration' => '2024_09_06_094051_create_permissions_table', 'batch' => 12],
            ['id' => 19, 'migration' => '2024_09_06_094120_create_role_permissions_table', 'batch' => 13],
            ['id' => 20, 'migration' => '2024_09_06_094151_create_payments_table', 'batch' => 14],
            ['id' => 21, 'migration' => '2024_09_06_094430_create_reservation_history_table', 'batch' => 15],
            ['id' => 22, 'migration' => '2024_09_06_094629_create_order_combos_table', 'batch' => 16],
            ['id' => 24, 'migration' => '2024_09_06_094700_create_order_dishes_table', 'batch' => 17],
            ['id' => 25, 'migration' => '2024_09_08_075613_create_feedback_table', 'batch' => 18],
            ['id' => 26, 'migration' => '2024_09_10_170123_create_suppliers_table', 'batch' => 19],
            ['id' => 27, 'migration' => '2024_09_10_182604_create_ingredient_types_table', 'batch' => 20],
            ['id' => 28, 'migration' => '2024_09_10_183214_create_ingredients_table', 'batch' => 21],
            ['id' => 29, 'migration' => '2024_09_11_093426_create_role_permissions_table', 'batch' => 22],
        ]);
    }
}
