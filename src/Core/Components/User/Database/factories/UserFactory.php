<?php

use MiPaPo\Core\Components\User\Database\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/** @var Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    static $password = 'secret';

    $firstname = $faker->firstName();
    $lastname = $faker->lastName;
    $initials = $firstname[0].$lastname[0];


    if (User::where('username', 'xPand')->count() === 0) {
        $user = User::create([
            'username' => 'xPand',
            'firstname' => 'Eric',
            'lastname' => 'Heinzl',
            'initials' => 'EH',
            'email' => 'xpand.4beatz@gmail.com',
            'birthday' => '1998-08-24',

            'password' => bcrypt($password),
            'api_token' => null,
            'remember_token' => Str::random(25),

            'email_verified_at' => now(),
        ]);

        $user->update([
            'id' => '0d408635-3dc6-455e-8356-720b927a54da'
        ]);
    }

    return [
        'username' => $faker->unique()->userName,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'initials' => $initials,
        'email' => $faker->unique()->safeEmail,
        'birthday' => $faker->date(),

        'password' => bcrypt($password),
        'api_token' => null,
        'remember_token' => Str::random(25),

        'email_verified_at' => now(),
    ];
});
