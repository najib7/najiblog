<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categorie;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $image = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg'];
    $title = $faker->sentence(rand(3, 6));

    return [
        'title'   => $title,
        'body'    => $faker->paragraphs(rand(2, 7), true),
        'image'   => $image[rand(0,4)],
        'slug'    => Str::slug($title),
        'user_id' => User::all()->random()->id,
        'cat_id'  => Categorie::all()->random()->id
    ];
});
