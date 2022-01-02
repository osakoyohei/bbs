<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'ゲストユーザー',
                'email' => 'guest@guest.jp',
                'password' => Hash::make('password'),
            ],
            [
                'id' => 2,
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('password'),
            ],
            [
                'id' => 3,
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password'),
            ],
            [
                'id' => 4,
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}