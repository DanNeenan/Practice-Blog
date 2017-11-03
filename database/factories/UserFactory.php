<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'about' => $faker->paragraph,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max=20),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
