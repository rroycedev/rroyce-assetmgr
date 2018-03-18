<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\RoleUser;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where("name", "Administrator")->first();

        $admin = User::where("uid", "admin")->first();

        if (!$admin) {
            $admin = new User();
        }

        $admin->uid = "admin";
        $admin->first_name = "Application";
        $admin->last_name = "Administrator";
        $admin->email = "admin@example.com";
        $admin->password = bcrypt("admin");
        $admin->is_system_object = 1;
        $admin->save();

        $arguments = array("role_id" => $role_admin->id, "user_id" => $admin->id);

        $role_mapping = RoleUser::where($arguments)->first();

        if (!$role_mapping) {
            $admin->roles()->attach($role_admin);    
        }

    }
}


