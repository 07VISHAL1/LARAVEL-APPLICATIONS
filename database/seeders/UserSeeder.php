<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
            'role_id' => '2',
            'name'=> 'vishal',
            'email'=>"vishalthakur6061@gmail.com",
            'password'=>Hash::make("Vishal@12345"),
            'role_id' => '1',

                 
            ]
        );
        DB::table('users')->insert(
            [
          
            'name'=> 'vishal',
            'email'=>"admin@admin.com",
            'password'=>Hash::make("Vishal@12345"),
            'role_id' => '2',

                 
            ]
        );
    }
    
}
