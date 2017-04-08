<?php

use App\Country;

$factory->define(App\Venue::class, function (Faker\Generator $faker) {
    $countries = Country::pluck('id')->toArray();

    return [
        'venue_name' => $faker->colorName,
        'address' => $faker->streetName,
        'details' => $faker->streetName,
        'city' => $faker->city,
        'CP' => $faker->postcode,
        'state' => $faker->colorName,
        'country_id' => $faker->randomElement($countries),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude
    ];
});