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
                'name' => '社 会・出 来 事',
            ],
            [
                'name' => '学 問・教 育',
            ],
            [
                'name' => '暮 ら し・生 活',
            ],
            [
                'name' => '趣 味・文 化',
            ],
            [
                'name' => '芸 能・放 送',
            ],
            [
                'name' => '雑 談・ネ タ',
            ],
            [
                'name' => 'その他',
            ],
        ]);
    }
}
