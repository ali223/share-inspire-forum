<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
	static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'job_title' => $faker->jobTitle,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10)
    ];
});
