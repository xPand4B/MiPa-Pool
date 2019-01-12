<?php

use Faker\Generator as Faker;
use App\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id'    => 1,
        'name'       => $faker->text(20),
        'site_link'  => $faker->url,
        'deadline'   => $faker->time,
        'max_orders' => $faker->numberBetween(1, 10)
    ];
});
