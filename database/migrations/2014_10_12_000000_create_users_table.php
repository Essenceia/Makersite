<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            //number of project in sub - groupe
            $table->integer('number')->unsigned()->comment('project number inside of a certain groupe , eg: PSTE220 has number 220 and type PSTE');
            //projet groupe number
            // 0 - PSTE
            //1 - PPE
            //2- PFE
            $table->enum('type',[0,1,2])->comment('defines the project groupe , here PSTE - 0 , PPE - 1 , PFE - 2');
            //intituler du projet
            $table->text('name');
            $table->timestamps();
            $table->integer('points')->unsigned()->default(0);

        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            /*
             * Status of acounte
             * 0- default
             * 1- membre
             * 2- moderateur ( makers )
             * 3- admin
             */
            $table->enum('status',[0,1,2,3])->default(0);
            $table->rememberToken()->nullable();
            $table->timestamps();
            /*
             * Project manadgement - if user is project head
             */
            $table->boolean('is_leader')->default(false);
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            $table->integer('points')->unsigned()->default(0)->comment('number of points a user can use on a machine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        Schema::dropIfExists('projet');

        Schema::dropIfExists('users');
    }
}
