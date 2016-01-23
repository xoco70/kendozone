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
            'name' => 'Juliatzin Del torro',
            'email'    => 'flordcactus@gmail.com',
            'password' => '$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau', // 111111
            'grade_id' => $faker->randomElement($grades),
            'country_id' => '484',
            'city' => 'Mexico City',
            'latitude' => '19.4342',
            'longitude' => '-99.1386',
            'role_id' => '1',
            'avatar' => 'https://lh3.googleusercontent.com/-1IZ2nbY2o40/AAAAAAAAAAI/AAAAAAAAHEY/KrhjLc7m66g/photo.jpg?sz=50',
            'token' => 'JgczvNP4eEn2LCHPj2MGg4obZooeIj',
            'verified' => '1',
            'provider' => 'google',
            'provider_id' => '113769489654625617770',
            'remember_token' => '7rCCxMRjsqSgHCt1mbOSkz5TV0iKe9YYVNMrOwX2g5pLUsF3qBqVQ1zlYOuv'
        ]);


        factory(User::class,5)->create(['role_id' => 2]);
        $this->command->info('seeding users!');
        factory(User::class)->create(['role_id' => 3]);
        factory(User::class)->create(['role_id' => 4]);
        factory(User::class)->create(['role_id' => 5]);



        $this->command->info('Users seeded!');

    }
}
