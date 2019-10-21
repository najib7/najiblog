<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $image = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg'];
    return [
        'title' => $faker->sentence(rand(3, 6)),
        'body'  => $faker->paragraphs(rand(2, 7), true),
        'image' => $image[rand(0,4)]
    ];
});
