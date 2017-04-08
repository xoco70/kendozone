<?php
use App\Country;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $countries = Country::pluck('id')->toArray();

    $email = $faker->email;
    return [
        'name' => $faker->name,
        'slug' => str_slug($email),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $email,
        'password' => bcrypt(str_random(10)),
        'grade_id' => $faker->numberBetween(1, 5),
        'country_id' => $faker->randomElement($countries),
        'city' => $faker->city,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'role_id' => $faker->numberBetween(1, 5),
        'verified' => true,
        'remember_token' => str_random(10),
        'provider' => 'created',
        'provider_id' => $email,
        'locale' => $faker->randomElement(['es','en'])

    ];
});