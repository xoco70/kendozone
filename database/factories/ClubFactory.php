<?php
use App\Association;
use App\Federation;
use App\User;

$factory->define(App\Club::class, function (Faker\Generator $faker) {
    $federations = Federation::all()->pluck('id')->toArray();
    $associations = Association::all()->pluck('id')->toArray();
    $users = User::all()->pluck('id')->toArray();

    return [
        'name' => $faker->text(10),
        'federation_id' => $faker->randomElement($federations),
        'association_id' => $faker->randomElement($associations),
        'president_id' => $faker->randomElement($users),
        'address' => $faker->streetName,
        'phone' => $faker->phoneNumber,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude

    ];
});