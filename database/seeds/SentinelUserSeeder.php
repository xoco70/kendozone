<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SentinelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        Sentinel::registerAndActivate([
            'email'    => 'user@user.com',
            'password' => 'sentineluser',
            'first_name' => 'UserFirstName',
            'last_name' => 'UserLastName',
        ]);

        Sentinel::registerAndActivate([
            'email'    => 'admin@admin.com',
            'password' => 'sentineladmin',
            'first_name' => 'AdminFirstName',
            'last_name' => 'AdminLastName',
        ]);

        $this->command->info('Users seeded!');

    }
}
