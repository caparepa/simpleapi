<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'birthdate' => $faker->dateTimeBetween('-40 years','now'),
    ];
});
