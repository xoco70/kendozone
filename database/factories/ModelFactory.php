<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\TournamentLevel;
use App\User;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'verified' => true,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tournament::class, function (Faker\Generator $faker) {
    $users = User::all()->pluck('id')->toArray();
    $levels = TournamentLevel::all()->pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($users),
        'name' => $faker->title,
        'date' => "2016-02-23",
        'registerDateLimit' => "2016-02-23",
        'cost' => $faker->numberBetween(10,500),
        'sport' => 1,
        'type' => $faker->boolean(),
        'mustPay' => $faker->boolean(),
        'venue' => $faker->address,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'level_id' => $faker->randomElement($levels),
    ];
});