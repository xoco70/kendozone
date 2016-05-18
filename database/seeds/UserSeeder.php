<?php

use App\Grade;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

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
//        $countries = Countries::all()->pluck('id')->toArray();
        User::create([
            'name' => 'No User',
            'email' => 'nouser@nouser.com',
        ]);
        User::create([
            'name' => 'Juliatzin Del torro',
            'email' => 'flordcactus@gmail.com',
            'password' => '$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau', // 111111
            'grade_id' => $faker->randomElement($grades),
            'country_id' => '484',
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
        ]);
        factory(User::class)->create(
            [   'name' => 'root',
                'email' => 'superuser@kendozone.com',
                'role_id' => Config::get('constants.ROLE_SUPERADMIN'),
                'password' => bcrypt('superuser'),
                'verified' => 1,]);
        factory(User::class)->create(
            [   'name' => 'federation',
                'email' => 'federation@kendozone.com',
                'role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT'),
                'password' => bcrypt('federation'),
                'verified' => 1,]);
        factory(User::class)->create(
            [   'name' => 'association',
                'email' => 'association@kendozone.com',
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
