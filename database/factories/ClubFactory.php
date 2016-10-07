<?php
use App\Association;
use App\User;

$factory->define(App\Club::class, function (Faker\Generator $faker) {
    $associations = Association::all()->pluck('id')->toArray();
    $users = User::all()->pluck('id')->toArray();

    return [
        'name' => $faker->text(10),
        'association_id' => $faker->randomElement($associations),
        'president_id' => $faker->randomElement($users),
        'address' => $faker->streetName,
        'phone' => $faker->phoneNumber,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude

    ];
});