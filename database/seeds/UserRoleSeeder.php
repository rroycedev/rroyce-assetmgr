<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if( DB::table('user_role')->get()->count() == 0){
            DB::table('user_role')->insert([
                'user_role_id' => 1,
                'role_name' => 'Administrator',
                'is_system_object' => 1,
            ]);
        }        
    }
}
