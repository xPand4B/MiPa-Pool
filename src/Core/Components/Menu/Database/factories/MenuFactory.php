<?php

use MiPaPo\Core\Components\Menu\Database\Menu;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Menu::class, function (Faker $faker) {
//    return [
//        'name'      => $faker->name(),
//        'number'    => $faker->numberBetween(1, 3),
//        'comment'   => $faker->realText(rand(10, 50)),
//        'price'     => $faker->numberBetween(100, 2000)
//    ];
});
