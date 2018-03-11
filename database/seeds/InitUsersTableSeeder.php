<?php

use Illuminate\Database\Seeder;

class InitUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uid' => 'admin',
            'first_name' => 'Asset Manager',
            'last_name' => 'Administrator',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
