<?php

use App\Admin;
use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'admin_id' => function () {
            return factory(Admin::class)->create()->id;
        }
    ];
});
