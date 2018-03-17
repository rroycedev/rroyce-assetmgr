<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if( DB::table('users')->get()->count() == 0){
            DB::table('users')->insert([
                'uid' => 'admin',
                'user_role_id' => 1,
                'first_name' => 'Asset Manager',
                'last_name' => 'Administrator',
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('admin'),
            ]);
        }
        else {
            DB::table('users')
            ->where('uid', 'admin')
            ->update(['user_role_id' => 1]);
        }
    }
}
