<?php

use App\Federation;
use App\User;

$factory->define(App\Association::class, function (Faker\Generator $faker) {
    $users = User::all()->pluck('id')->toArray();
    $federations = Federation::all()->pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'federation_id' => $faker->randomElement($federations),
        'president_id' => $faker->randomElement($users),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
    ];
});