<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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

        Sentinel::registerAndActivate([
            'email'    => 'admin@admin.com',
            'password' => 'sentineladmin',
            'first_name' => 'AdminFirstName',
            'last_name' => 'AdminLastName',
        ]);

//        Sentinel::registerAndActivate([
//            'email'    => 'moderator@admin.com',
//            'password' => 'moderator',
//            'first_name' => 'ModeratorFirstName',
//            'last_name' => 'ModeratorLastName',
//        ]);

        Sentinel::registerAndActivate([
            'email'    => 'user@user.com',
            'password' => 'sentineluser',
            'first_name' => 'UserFirstName',
            'last_name' => 'UserLastName',
        ]);



        $this->command->info('Users seeded!');

    }
}
