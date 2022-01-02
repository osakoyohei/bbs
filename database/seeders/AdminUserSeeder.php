<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            [
                'id' => 1,
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'name' => 'admin',
            ],
        ]);
    }
}
