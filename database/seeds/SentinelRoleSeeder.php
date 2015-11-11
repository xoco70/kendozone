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
            'name' => 'Moderator',
            'slug' => 'moderator',
        ]);
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'User',
            'slug' => 'user',
        ]);


        $this->command->info('Roles seeded!');
    }
}
