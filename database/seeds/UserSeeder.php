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


        factory(User::class,30)->create();



        $this->command->info('Users seeded!');

    }
}
