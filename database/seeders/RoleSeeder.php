<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // --- Admin & User For Testing--- \\ 
        DB::table('users')->insert([
            'email'                   =>'admin@gmail.com',
            'name'                   =>'Admin',
            'usertype'              =>'admin',
            'email_verified_at' =>now(),
            'email_verified_at' =>now(),
            'created_at'           =>now(),
            'updated_at'          =>now(),
            'password'=>Hash::make('Admin@1234') // <---- check this
        ]);

        DB::table('users')->insert([
            'email'                   =>'user@gmail.com',
            'name'                   =>'User',
            'usertype'              =>'user',
            'email_verified_at' =>now(),
            'created_at'           =>now(),
            'updated_at'          =>now(),
            'password'=>Hash::make('User@1234') // <---- check this
        ]);
    }
}
