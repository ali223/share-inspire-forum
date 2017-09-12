<?php

use Faker\Generator as Faker;

$factory->define(App\ChatMessage::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        'user_id' => 1
    ];
});
