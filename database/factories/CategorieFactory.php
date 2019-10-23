<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categorie;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Categorie::class, function (Faker $faker) {
    $name = $faker->words(rand(1,2), true);
    return [
        'name'  => $name ,
        'description' => $faker->sentence(8, true),
        'slug'  => Str::slug($name)
    ];
});
