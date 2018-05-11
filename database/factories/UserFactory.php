<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'username' => str_slug($faker->userName,'_'),
        'email' => $faker->unique()->email,
        'password' => Hash::make('secret'),
        'remember_token' => str_random(10),
    ];
});
