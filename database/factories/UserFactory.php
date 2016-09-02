<?php
use Webpatser\Countries\Countries;
use App\User;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $countries = Countries::all()->pluck('id')->toArray();
//    $federations = Federation::all()->pluck('id')->toArray();
//    $associations = Association::all()->pluck('id')->toArray();
//    $clubs = Club::all()->pluck('id')->toArray();

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
//        'federation_id' => $faker->randomElement($federations),
//        'association_id' => $faker->randomElement($associations),
//        'club_id' => $faker->randomElement($clubs),
        'city' => $faker->city,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'role_id' => $faker->numberBetween(1, 5),
        'verified' => true,
        'remember_token' => str_random(10),
        'provider' => '',
        'provider_id' => str_random(5),
        'locale' => $faker->randomElement(['es','en'])

    ];
});