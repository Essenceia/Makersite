<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatDefaultCostSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_default',function (Blueprint $table){
            $table->increments('id');
            //PSTE
            $table->integer('project_type0')->default(10);
            //PPE
            $table->integer('project_type1')->default(20);
            //PFE
            $table->integer('project_type2')->default(30);
            //eleve standard
            $table->integer('user_type0')->default(0);
            //membre du club
            $table->integer('user_type1')->default(10);
            //moderateurs
            $table->integer('user_type2')->default(30);
            //admin , ont s'en fout il ne paille meme pas
            $table->integer('user_type3')->default(100);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points_default');
    }
}
