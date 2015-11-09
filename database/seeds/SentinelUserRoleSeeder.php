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
        DB::table('role_users')->delete();

        $userUser = Sentinel::findByCredentials(['login' => 'user@user.com']);
        $adminUser = Sentinel::findByCredentials(['login' => 'admin@admin.com']);

        $userRole = Sentinel::findRoleByName('Users');
        $adminRole = Sentinel::findRoleByName('Admins');

        // Assign the roles to the users
        $userRole->users()->attach($userUser);
        $adminRole->users()->attach($adminUser);

        $this->command->info('Users assigned to roles seeded!');
    }
}
