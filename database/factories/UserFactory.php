<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username'          => $faker->userName,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',   // password
        'last_login'        => Carbon::now()
    ];
});

$factory->define(Profile::class, function(Faker $faker) {

    $list_countires = config('blog.country_list');

    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'about'      => $faker->paragraph(3, true),
        'country'    => $faker->randomElement($list_countires),
        'gender'     => $faker->randomElement(['male', 'female']),
    ];
});
