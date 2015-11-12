<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->truncate();
        Role::create(['name' => "SuperAdmin",'label' => 'SuperAdmin']);
        Role::create(['name' => "Owner",'label' => 'Owner']);
        Role::create(['name' => "Admin",'label' => 'Admin']);
        Role::create(['name' => "Moderator",'label' => 'Moderator']);
        Role::create(['name' => "User",'label' => 'User']);

        $this->command->info('Roles seeded!');
    }
}
