<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('blog.categories');
        $faker = Factory::create();

        $table = DB::table('categories');
        foreach ($categories as $categorie) {
            $table->insert([
                'name'        => $categorie,
                'slug'        => $categorie,
                'description' => $faker->paragraph(3, true) // just for test
            ]);
        }
    }
}
