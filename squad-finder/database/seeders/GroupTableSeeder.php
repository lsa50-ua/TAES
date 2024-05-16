<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('groups')->delete();

        DB::table('groups')->insert([
            'name'=>'RBB',
            'language'=>'Spanish',
            'game_id'=>1,
            'crossplay'=>false,
            'nMaxUsers'=>5,
            'platform_id'=>1
        ]);  
            
    }
}
