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
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'post_id' => function () {
            return factory('App\Post')->create()->id;
        },
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    $date = now()->addWeeks(-rand(1, 23))->addSeconds(-rand(1, 2160000));
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'created_at' => $date,
        'updated_at' => $date
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'post_id' => function () {
            return factory('App\Post')->create()->id;
        },
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});
