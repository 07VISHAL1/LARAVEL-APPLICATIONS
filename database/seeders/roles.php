<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 
        DB::table('roles')->insert(
            [
            'id' => '2',
            'name'=> 'admin',     
            ]
        );
    }
}
