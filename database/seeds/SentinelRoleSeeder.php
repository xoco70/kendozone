<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SentinelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->truncate();


        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'SuperAdmin',
            'slug' => 'superadmin',
        ]);
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Owner',
            'slug' => 'owner',
        ]);
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Users',
            'slug' => 'users',
        ]);
//
//        Sentinel::getRoleRepository()->createModel()->create([
//            'name' => 'Admins',
//            'slug' => 'admins',
//        ]);

        $this->command->info('Roles seeded!');
    }
}
