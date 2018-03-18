<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $role_administrator = Role::where("name", "Administrator")->first();

        if (!$role_administrator) {
            $role_administrator = new Role();
        }

        $role_administrator->name = "Administrator";
        $role_administrator->description = "Administers the website";
        $role_administrator->is_system_object = 1;
        $role_administrator->save();

        $role_usermgr = Role::where("name", "User Manager")->first();

        if (!$role_usermgr) {
            $role_usermgr = new Role();
        }

        $role_usermgr->name = "User Manager";
        $role_usermgr->description = "Manages users";
        $role_usermgr->is_system_object = 1;
        $role_usermgr->save();    
    }
}