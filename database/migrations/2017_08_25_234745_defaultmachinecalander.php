<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Defaultmachinecalander extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_calander_default',function (Blueprint $table){
            $table->increments('id');
            $table->boolean('open');
            $table->time('time');
            $table->integer('day')->unsigned();
            $table->integer('machine_id')->unsigned();
            $table->foreign('machine_id' )->references('id')->on('machine')->onDelete('cascade')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('machine_calander_default');
    }
}
