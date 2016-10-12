<?php

use App\Association;
use App\Club;
use App\Federation;
use App\Grade;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Webpatser\Countries\Countries;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $grades = Grade::all()->pluck('id')->toArray();
//        $federations = Federation::all()->pluck('id')->toArray();
//        $associations = Association::all()->pluck('id')->toArray();
//        $clubs = Club::all()->pluck('id')->toArray();
        $countries = Countries::pluck('id')->toArray();

        User::create([
            'name' => 'No User',
            'email' => 'nouser@nouser.com',
            'password' => bcrypt('0'),
            'provider' => '0',
        ]);
        User::create([
            'name' => 'Juliatzin Del torro',
            'email' => 'flordcactus@gmail.com',
            'password' => '$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau', // 111111
            'grade_id' => $faker->randomElement($grades),
            'country_id' => 484,
//            'federation_id' => $faker->randomElement($federations),
//            'association_id' => $faker->randomElement($associations),
//            'club_id' => $faker->randomElement($clubs),
            'city' => 'Mexico City',
            'latitude' => '19.4342',
            'longitude' => '-99.1386',
            'role_id' => Config::get('constants.ROLE_SUPERADMIN'),
            'avatar' => 'https://lh3.googleusercontent.com/-1IZ2nbY2o40/AAAAAAAAAAI/AAAAAAAAHEY/KrhjLc7m66g/photo.jpg?sz=50',
            'token' => 'JgczvNP4eEn2LCHPj2MGg4obZooeIj',
            'verified' => '1',
            'provider' => 'google',
            'provider_id' => '113769489654625617770',
            'remember_token' => '7rCCxMRjsqSgHCt1mbOSkz5TV0iKe9YYVNMrOwX2g5pLUsF3qBqVQ1zlYOuv'
        ]); // Root Google
        factory(User::class)->create(
            [   'name' => 'root',
                'email' => 'superuser@kendozone.com',
                'country_id' => 484,
//                'federation_id' => $faker->randomElement($federations),
//                'association_id' => $faker->randomElement($associations),
                'role_id' => Config::get('constants.ROLE_SUPERADMIN'),
                'password' => bcrypt('superuser'),
                'verified' => 1,]); // Root UI
        factory(User::class)->create(
            [   'name' => 'federation',
                'email' => 'federation@kendozone.com',
                'country_id' => $faker->randomElement($countries),
//                'federation_id' => $faker->randomElement($federations),
//                'association_id' => $faker->randomElement($associations),
                'role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT'),
                'password' => bcrypt('federation'),
                'verified' => 1,]); // Federation Random Country : Pass federation
        factory(User::class)->create(
            [   'name' => 'association',
                'email' => 'association@kendozone.com',
                'country_id' => $faker->randomElement($countries),
//                'federation_id' => $faker->randomElement($federations),
//                'association_id' => $faker->randomElement($associations),
                'role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT'),
                'password' => bcrypt('association'),
                'verified' => 1,]);

        factory(User::class)->create(
            [   'name' => 'club',
                'email' => 'club@kendozone.com',
                'role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT'),
                'password' => bcrypt('club'),
                'verified' => 1,]);


        factory(User::class)->create(
            [   'name' => 'user',
                'email' => 'user@kendozone.com',
                'country_id' => $faker->randomElement($countries),
//                'federation_id' => $faker->randomElement($federations),
//                'association_id' => $faker->randomElement($associations),
                'role_id' => Config::get('constants.ROLE_USER'),
                'password' => bcrypt('user'),
                'verified' => 1,]);

//        foreach ($countries as $country){
//            factory(User::class)->create(
//                [   'country_id' => $country,
//                    'verified' => 1]);
//        }



        $this->command->info('Users seeded!');

    }
}
