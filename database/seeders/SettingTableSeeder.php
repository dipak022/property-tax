<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('setings')->insert([
           
            'website_name'=>'Tachnical Equipment Slover',
            'short_desc'=>'Tachnical Equipment Slover',
            'address'=>'Dhaka dhanmondi',
            'email'=>'problem.solve@gmail.com',
            'phone'=>'0162564554',
            'footer'=>'Linkon',
            'facebook_url'=>'https://facebook.com/',
            'twitter_url'=>'https://facebook.com/',
            'linkedin_url'=>'https://facebook.com/',
            'skype_link'=>'https://facebook.com/',
            'instagram_link'=>'https://facebook.com/',
            ]);

         
    }
}
