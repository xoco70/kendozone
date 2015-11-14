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

//        Sentinel::registerAndActivate([
//            'email'    => 'superadmin@admin.com',
//            'password' => 'superadmin',
//            'first_name' => 'SuperAdminFirstName',
//            'last_name' => 'SuperAdminLastName',
//        ]);

//        Sentinel::registerAndActivate([
//            'email'    => 'owner@admin.com',
//            'password' => 'owner',
//            'first_name' => 'OwnerFirstName',
//            'last_name' => 'OwnerLastName',
//        ]);

        User::create([
            'email'    => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'name' => 'AdminFirstName',
            'roleId' => '3'
        ]);

//        Sentinel::registerAndActivate([
//            'email'    => 'moderator@admin.com',
//            'password' => 'moderator',
//            'first_name' => 'ModeratorFirstName',
//            'last_name' => 'ModeratorLastName',
//        ]);

        User::create([
            'email'    => 'user@user.com',
            'password' => bcrypt('user'),
            'name' => 'UserFirstName',
            'roleId' => '5'

        ]);



        $this->command->info('Users seeded!');

    }
}
