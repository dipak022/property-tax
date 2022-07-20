<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            // Super Admin 
            [
                'name'=> 'Super Admin',
                'type'=> '',
                'phone'=> '',
                'email'=> 'superadmin@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> '1',
                'active'=> 1,
            ],
            //  Admin 
            [
                'name'=> 'Officer',
                'type'=> '',
                'phone'=> '',
                'email'=> 'Officer@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> '2',
                'active'=> 1,

            ],
            //  user
            [
                'name'=> 'User',
                'type'=> '',
                'phone'=> '',
                'email'=> 'user@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> '3',
                'active'=> 1,

            ],
            //Technician
            [
                'name'=> 'Technician',
                'type'=> 'Computer',
                'phone'=> '01888888888',
                'email'=> 'technician@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> '4',
                'active'=> 1,

            ],
           
        
         ]);
    }
}
