<?php

use App\Topic;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'approved' => 0,
        'topic_id' => function () {
            return factory(Topic::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
