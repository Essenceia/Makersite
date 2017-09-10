<?php

use Illuminate\Database\Seeder;

class TeamMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team')->insert(['name'=>'Percno 1','desc'=>'C est un mec','year'=>2017]);
        DB::table('team')->insert(['name'=>'Percno 1','desc'=>'C est un mec','year'=>2017]);
        DB::table('team')->insert(['name'=>'Percno 1','desc'=>'C est un mec','year'=>2017]);
        DB::table('team')->insert(['name'=>'Percno 1','desc'=>'C est un mec','year'=>2017]);
        DB::table('team')->insert(['name'=>'Percno 1','desc'=>'C est un mec','year'=>2016]);
        DB::table('team')->insert(['name'=>'Percno 1','desc'=>'C est un mec','year'=>2016]);
        DB::table('team')->insert(['name'=>'Percno 1','desc'=>'C est un mec','year'=>2016]);
    }
}
