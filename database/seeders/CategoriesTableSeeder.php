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
                'id' => '1',
                'name' => 'カテゴリ−1',
            ],
            [
                'id' => '2',
                'name' => 'カテゴリ−2',
            ],
            [
                'id' => '3',
                'name' => 'カテゴリ−3',
            ],
        ]);
    }
}
