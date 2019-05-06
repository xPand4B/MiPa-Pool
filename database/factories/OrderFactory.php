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

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id'    => function(){
            return App\User::inRandomOrder()->first()->id;
        },
        'name'       => $faker->text(20),
        'site_link'  => $faker->url,
        'deadline'   => $faker->time,
        'max_orders' => $faker->numberBetween(2, 15)
    ];
});
