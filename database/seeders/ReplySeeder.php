<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('replies')->insert([
            [
                'user_id' => 1,
                'comment_id' => 1,
                'reply' => 'コメントありがとうございます!',
                'created_at' => '2021/12/13 18:18:18',
                'updated_at' => '2021/12/13 18:18:18',
            ],
            [
                'user_id' => 1,
                'comment_id' => 3,
                'reply' => 'よろしくお願いします!',
                'created_at' => '2021/12/15 17:17:17',
                'updated_at' => '2021/12/15 17:17:17',
            ],
            [
                'user_id' => 2,
                'comment_id' => 4,
                'reply' => 'よろしくです!',
                'created_at' => '2021/12/16 11:11:11',
                'updated_at' => '2021/12/16 11:11:11',
            ],
            [
                'user_id' => 1,
                'comment_id' => 2,
                'reply' => 'よろしく!',
                'created_at' => '2021/12/13 15:15:15',
                'updated_at' => '2021/12/13 15:15:15',
            ],
            [
                'user_id' => 4,
                'comment_id' => 2,
                'reply' => 'こんにちは!',
                'created_at' => '2021/12/13 19:11:11',
                'updated_at' => '2021/12/13 19:11:11',
            ],
            [
                'user_id' => 2,
                'comment_id' => 2,
                'reply' => 'どうも!',
                'created_at' => '2021/12/13 13:13:13',
                'updated_at' => '2021/12/13 13:13:13',
            ],
        ]);
    }
}
