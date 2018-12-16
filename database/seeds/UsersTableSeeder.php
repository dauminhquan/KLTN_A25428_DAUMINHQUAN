<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'email' => 'admin@gmail.com',
           'password' => Hash::make('admin'),
            'authentication' => 1,
            'type' => 1
        ]);
        DB::table('admins')->insert([
            'name' => 'Admin',
            'user_id' => 1
        ]);
    }
}
