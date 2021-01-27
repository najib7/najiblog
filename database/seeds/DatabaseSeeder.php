<?php

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
        $this->call([
            RolesAndPermissionsSeeder::class,
            FirstUsersSeeder::class,
            CategoriesTableSeeder::class,

            // fake data
            UsersTableSeeder::class,
            PostsTableSeeder::class,
        ]);
    }
}
