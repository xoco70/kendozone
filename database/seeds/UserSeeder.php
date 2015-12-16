<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
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


        User::create([
            'name' => 'xoco',
            'email'    => 'xoco70@hotmail.com1',
            'password' => '$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau', // 111111
            'grade_id' => '9',
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

        $faker = Faker::create();

        foreach ( range(2,100) as $index){
            User::create([
                'name' => $faker->name,
                'email'    => $faker->email,
                'password' => bcrypt('secret'), // 111111
                'grade_id' => $faker->numberBetween(1,5),
                'country_id' => 4,
                'city' => $faker->city,
                'latitude' => $faker->randomDigit,
                'longitude' => $faker->randomDigit,
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
