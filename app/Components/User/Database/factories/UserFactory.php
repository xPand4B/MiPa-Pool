<?php

use App\Components\User\Database\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/** @var Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    static $password = 'secret';

    return [
        'username' => $faker->unique()->userName,
        'firstname' => $faker->firstName(),
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'birthday' => $faker->date(),

        'password' => bcrypt($password),
        'api_token' => null,
        'remember_token' => Str::random(25),

        'email_verified_at' => now(),
    ];
});
