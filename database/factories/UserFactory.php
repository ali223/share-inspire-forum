<?php

use Illuminate\Support\Str;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'about' => $faker->sentence(),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10),
    ];
});
