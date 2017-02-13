<?php


use App\Category;
use App\Championship;
use App\Tournament;

$factory->define(Championship::class, function (Faker\Generator $faker) {
    $tournaments = Tournament::all()->pluck('id')->toArray();
    $categories = Category::all()->pluck('id')->toArray();

    return [
        'tournament_id' => $faker->randomElement($tournaments),
        'category_id' => $faker->randomElement($categories),
    ];
});