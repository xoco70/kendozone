<?php

use App\TournamentLevel;
use App\User;

$factory->define(App\Tournament::class, function (Faker\Generator $faker) {
    $users = User::all()->pluck('id')->toArray();
    $levels = TournamentLevel::all()->pluck('id')->toArray();
    $dateIni = $faker->dateTimeBetween('now', '+2 weeks')->format('Y-m-d');
    $venues = \App\Venue::all()->pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'name' => $faker->name,
        'dateIni' => $dateIni,
        'dateFin' => $dateIni,
        'registerDateLimit' => $dateIni,
        'sport' => 1,
        'type' => $faker->boolean(),
        'venue_id' => $faker->randomElement($venues),
        'level_id' => $faker->randomElement($levels),
    ];
});