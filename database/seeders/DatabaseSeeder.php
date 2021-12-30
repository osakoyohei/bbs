<?php

namespace Database\Seeders;

use App\Models\Reply;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            CategoriesTableSeeder::class,
            UserSeeder::class,
            AdminUserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            ReplySeeder::class,
        ]);
    }
}
