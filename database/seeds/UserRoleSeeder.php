<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SentinelUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->truncate();
        $superAdminUser = Sentinel::findByCredentials(['login' => 'superadmin@admin.com']);
        $ownerUser = Sentinel::findByCredentials(['login' => 'owner@admin.com']);
        $adminUser = Sentinel::findByCredentials(['login' => 'admin@admin.com']);
        $moderatorUser = Sentinel::findByCredentials(['login' => 'moderator@admin.com']);
        $userUser = Sentinel::findByCredentials(['login' => 'user@user.com']);




        $superAdminRole = Sentinel::findRoleByName('SuperAdmin');
        $ownerRole = Sentinel::findRoleByName('Owner');
        $adminRole = Sentinel::findRoleByName('Admin');
        $moderatorRole = Sentinel::findRoleByName('Moderator');
        $userRole = Sentinel::findRoleByName('User');


        // Assign the roles to the users
        $superAdminRole->users()->attach($superAdminUser);
        $ownerRole->users()->attach($ownerUser);
        $adminRole->users()->attach($adminUser);
        $moderatorRole->users()->attach($moderatorUser);
        $userRole->users()->attach($userUser);


        $this->command->info('Users assigned to roles seeded!');
    }
}
