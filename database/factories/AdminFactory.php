<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Admin::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'job_title' => $faker->jobTitle,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10)
    ];
});
