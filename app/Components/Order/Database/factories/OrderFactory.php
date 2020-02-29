<?php

use App\Components\Order\Database\Order;
use App\Components\User\Database\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Carbon\Carbon;

/** @var Factory $factory */
$factory->define(Order::class, function (Faker $faker) {
    $deadline = new Carbon();

//    return [
//        'user_id'    => function(){
//            return User::inRandomOrder()->first()->id;
//        },
//        'name'              => $faker->text(20),
//        'delivery_service'  => $faker->name,
//        'site_link'         => $faker->url,
//        'deadline'          => $deadline->addSeconds(rand(600, 86400)), // Between 10min and 24h
//        'minimum_value'     => $faker->numberBetween(0, 10),
//        'max_orders'        => $faker->numberBetween(2, 15),
//    ];
});
