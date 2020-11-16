<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_posts')->insert([

            [
            'category_id' => '1',
            'post_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'category_id' => '1',
            'post_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'category_id' => '1',
            'post_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'category_id' => '1',
            'post_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        ]);
    }
}
