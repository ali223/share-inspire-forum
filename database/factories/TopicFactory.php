<?php

use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'approved' => 0,
        'category_id' => function () {
        	return factory(Category::class)->create()->id;
        },
        'user_id' => function () {
        	return factory(User::class)->create()->id;
        }
    ];
});
