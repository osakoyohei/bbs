<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'id' => 1,
                'user_id' => 4,
                'post_id' => 1,
                'comment' => 'コメント失礼します!',
                'created_at' => '2021/12/13 11:22:22',
                'updated_at' => '2021/12/13 11:22:22',
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'post_id' => 1,
                'comment' => 'こんにちは!',
                'created_at' => '2021/12/13 11:33:33',
                'updated_at' => '2021/12/13 11:33:33',
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'post_id' => 2,
                'comment' => 'はじめまして!',
                'created_at' => '2021/12/15 11:22:22',
                'updated_at' => '2021/12/15 11:22:22',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'post_id' => 2,
                'comment' => 'よろしくお願いします!',
                'created_at' => '2021/12/15 11:33:33',
                'updated_at' => '2021/12/15 11:33:33',
            ],
        ]);
    }
}
