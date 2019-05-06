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
    static $password = 'secret';

    return [
        'username'       => $faker->unique()->userName,
        'firstname'      => $faker->firstName(),
        'surname'        => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'aboutMe'        => $faker->text(),
        'password'       => bcrypt($password),
        'remember_token' => str_random(10),
    ];
});
