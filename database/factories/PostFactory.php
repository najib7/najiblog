<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Categorie;
use Faker\Generator as Faker;


$factory->define(Post::class, function (Faker $faker) {
    $dir = scandir(storage_path('app\public\images\fake'));
    $images = array_diff($dir, array('..', '.'));
    $title = $faker->sentence(rand(3, 6));
    static $index_image = 2;

    $rand = rand(3, 10);
    $body = '';

    for ($i = 0; $i < $rand; $i++) { 
        $body .= '<p>' . $faker->paragraph(5 , true) . '</p>';
    }
    
    return [
        'title'   => $title,
        'body'    => $body,
        'image'   => 'fake/' . $images[$index_image++],
        'slug'    => Str::slug($title),
        'user_id' => User::all()->random()->id,
        'cat_id'  => Categorie::all()->random()->id
    ];
});
