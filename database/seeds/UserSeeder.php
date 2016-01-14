<?php

use App\Grade;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
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
        DB::table('users')->truncate();
        $faker = Faker::create();

        $grades = Grade::all()->pluck('id')->toArray();
        User::create([
            'name' => 'xoco',
            'email'    => 'xoco70@hotmail.com1',
            'password' => '$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau', // 111111
            'grade_id' => $faker->randomElement($grades),
            'country_id' => '4',
            'city' => 'Mexico City',
            'latitude' => '19.4342',
            'longitude' => '-99.1386',
            'role_id' => '3',
            'avatar' => 'avatar.png',
            'verified' => '1',
            'provider' => '',
            'provider_id' => '1'
        ]);


        $countries = Countries::all()->pluck('id')->toArray();

        foreach ( range(2,30) as $index){
            User::create([
                'name' => $faker->name,
                'email'    => $faker->email,
                'password' => bcrypt('secret'), // 111111
                'grade_id' => $faker->numberBetween(1,5),
                'country_id' => $faker->randomElement($countries),
                'city' => $faker->city,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'role_id' => $faker->numberBetween(1,3),
                'verified' => $faker->numberBetween(0,1),
                'provider' => '',
                'provider_id' => $index
            ]);
        }


//        User::create([
//            'email'    => 'user@user.com',
//            'password' => '$2y$10$ZkpACe1Xq7OblA2Jvb5CiO2gFw7716X7HdnHexPMAEMKvHlj7fIWu', // 111111
//            'name' => 'UserFirstName',
//            'verified' => '1',
//            'roleId' => '5',
//            'provider' => 'seed',
//            'provider_id' => '2'
//
//
//        ]);



        $this->command->info('Users seeded!');

    }
}
