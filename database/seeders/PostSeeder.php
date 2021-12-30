<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'title' => 'test1',
                'thumbnail_image' => '',
                'content' => 'テスト１です',
                'category_id' => 1,
                'created_at' => '2021/12/13 11:11:11',
                'updated_at' => '2021/12/13 11:11:11',
            ],
            [
                'user_id' => 2,
                'title' => 'test2',
                'thumbnail_image' => '',
                'content' => 'テスト２です',
                'category_id' => 2,
                'created_at' => '2021/12/15 11:11:11',
                'updated_at' => '2021/12/15 11:11:11',
            ],
        ]);
    }
}
