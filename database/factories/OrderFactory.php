<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

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
    $deadline = new Carbon();

    return [
        'user_id'    => function(){
            return App\User::inRandomOrder()->first()->id;
        },
        'name'              => $faker->text(20),
        'delivery_service'  => $faker->name,
        'site_link'         => $faker->url,
        'deadline'          => $deadline->addSeconds(rand(600, 86400)), // Between 10min and 24h
        'max_orders'        => $faker->numberBetween(2, 15)
    ];
});
