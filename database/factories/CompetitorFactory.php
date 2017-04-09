<?php

use App\Championship;
use App\Competitor;
use App\User;

$factory->define(Competitor::class, function (Faker\Generator $faker) {
    $championships = Championship::all()->pluck('id')->toArray();
    $users = User::all()->pluck('id')->toArray();
    $championshipId = $faker->randomElement($championships);

    return [
        'championship_id' => $championshipId,
        'user_id' => $faker->randomElement($users),
        'confirmed' => $faker->numberBetween(0, 1),
//        'short_id' =>
    ];
});
