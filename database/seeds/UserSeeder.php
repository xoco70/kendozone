<?php

use App\User;
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


        User::create([
            'name' => 'xoco',
            'email'    => 'xoco70@hotmail.com1',
            'password' => '$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau', // 111111
            'gradeId' => '9',
            'countryId' => '484',
            'roleId' => '3',
            'avatar' => 'avatar.png',
            'verified' => '1',
            'provider' => '',
            'provider_id' => '1'
        ]);


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
