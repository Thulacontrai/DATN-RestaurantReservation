<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersonalAccessTokensSeeder extends Seeder
{
    public function run()
    {
        DB::table('personal_access_tokens')->insert([
            ['id' => 1, 'tokenable_type' => 'App\\Models\\User', 'tokenable_id' => 1, 'name' => 'token1', 'token' => 'sometoken1', 'abilities' => '["*"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'tokenable_type' => 'App\\Models\\User', 'tokenable_id' => 2, 'name' => 'token2', 'token' => 'sometoken2', 'abilities' => '["*"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'tokenable_type' => 'App\\Models\\User', 'tokenable_id' => 3, 'name' => 'token3', 'token' => 'sometoken3', 'abilities' => '["*"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
