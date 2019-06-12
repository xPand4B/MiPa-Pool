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

$factory->define(App\Menu::class, function (Faker $faker) {
    return [
        'name'      => $faker->name(),
        'number'    => $faker->numberBetween(1, 3),
        'comment'   => $faker->realText(rand(10, 50)),
        'price'     => $faker->numberBetween(100, 2000)
    ];
});
