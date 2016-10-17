<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Roles seeding!');
        DB::table('roles')->truncate();
        Role::create(['name' => "SuperAdmin",'label' => 'SuperAdmin']);
        Role::create(['name' => "FederationPresident",'label' => 'roles.federation.president']);
        Role::create(['name' => "AssociationPresident",'label' => 'roles.association.president']);
        Role::create(['name' => "ClubPresident",'label' => 'roles.club.president']);
        Role::create(['name' => "user",'label' => 'roles.user']);


    }
}
