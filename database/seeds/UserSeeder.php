<?php

use App\Country;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Users seeding!');
        $faker = Faker::create();

        $countries = Country::pluck('id')->toArray();

        factory(User::class)->create(
            ['name' => 'root',
                'email' => 'superuser@kendozone.dev',
                'country_id' => 484,
                'role_id' => Config::get('constants.ROLE_SUPERADMIN'),
                'password' => bcrypt('superuser'),
                'verified' => 1,]); // Root UI
        factory(User::class)->create(
            ['name' => 'federation',
                'email' => 'federation@kendozone.dev',
                'country_id' => $faker->randomElement($countries),
                'role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT'),
                'password' => bcrypt('federation'),
                'verified' => 1,]); // Federation Random Country : Pass federation
        factory(User::class)->create(
            ['name' => 'association',
                'email' => 'association@kendozone.dev',
                'country_id' => $faker->randomElement($countries),
                'role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT'),
                'password' => bcrypt('association'),
                'verified' => 1,]);

        factory(User::class)->create(
            ['name' => 'club',
                'email' => 'club@kendozone.dev',
                'role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT'),
                'password' => bcrypt('club'),
                'verified' => 1,]);


        factory(User::class)->create(
            ['name' => 'user',
                'email' => 'user@kendozone.dev',
                'country_id' => $faker->randomElement($countries),
                'role_id' => Config::get('constants.ROLE_USER'),
                'password' => bcrypt('user'),
                'verified' => 1,]);
    }
}
