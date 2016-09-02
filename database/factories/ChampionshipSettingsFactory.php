<?php


use App\Championship;

$factory->define(App\CategorySettings::class, function (Faker\Generator $faker) use ($factory) {
    $tcs = Championship::all()->pluck('id')->toArray();

    return [
        'championship_id' => $faker->randomElement($tcs),
//        'isTeam' => $faker->boolean(),
        'teamSize' => $faker->numberBetween(0, 6),
        'fightingAreas' => $faker->numberBetween(0, 4),
        'fightDuration' => "03:00",
        'hasRoundRobin' => $faker->boolean(),
        'roundRobinWinner' => $faker->numberBetween(1, 2),
        'hasEncho' => $faker->boolean(),
        'enchoQty' => $faker->numberBetween(0, 4),
        'enchoDuration' => "01:00",
        'hasHantei' => $faker->boolean(),
        'cost' => $faker->numberBetween(0, 100),
        'roundRobinGroupSize' => $faker->numberBetween(0, 10),
        'roundRobinDuration' => $faker->numberBetween(0, 10),
        'seedQuantity' => $faker->numberBetween(0, 4),
        'hanteiLimit' => $faker->numberBetween(0, 10), // 1/2 Finals
        'enchoTimeLimitless' => $faker->numberBetween(0, 10), // Step where Encho has no more time limit
        'limitByEntity' => $faker->numberBetween(0, 10),

    ];
});