<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role;
        $role_admin->name = 'admin';
        $role_admin->save();

        $role_landlord = new Role;
        $role_landlord->name = 'landlord';
        $role_landlord->save();

        $role_agent = new Role;
        $role_agent->name = 'agent';
        $role_agent->save();

        $role_tenant = new Role;
        $role_tenant->name = 'tenant';
        $role_tenant->save();

        $role_caretaker = new Role;
        $role_caretaker->name = 'caretaker';
        $role_caretaker->save();
    }
}
