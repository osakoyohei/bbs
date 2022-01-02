<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => '社 会・出 来 事',
            ],
            [
                'id' => 2,
                'name' => '学 問・教 育',
            ],
            [
                'id' => 3,
                'name' => '暮 ら し・生 活',
            ],
            [
                'id' => 4,
                'name' => '趣 味・文 化',
            ],
            [
                'id' => 5,
                'name' => '芸 能・放 送',
            ],
            [
                'id' => 6,
                'name' => '雑 談・ネ タ',
            ],
            [
                'id' => 7,
                'name' => 'その他',
            ],
        ]);
    }
}
