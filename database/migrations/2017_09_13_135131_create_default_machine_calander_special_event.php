<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultMachineCalanderSpecialEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_calander_event',function (Blueprint $table){
            $table->increments('id');
            $table->text('name');
            $table->text('desc');
        });
        Schema::create('machine_calander_event_date',function (Blueprint $table){
            $table->increments('id');
            $table->date('monday_week_date');
            $table->integer('machine_id')->unsigned();
            $table->foreign('machine_id' )->references('id')->on('machine')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id' )->references('id')->on('machine_calander_event')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::create('machine_calander_special',function (Blueprint $table){
            $table->increments('id');
            $table->boolean('open');
            $table->time('time');
            $table->integer('day')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id' )->references('id')->on('machine_calander_event')->onDelete('cascade')->onUpdate('cascade');});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machine_calander_default');
        Schema::dropIfExists('machine_calander_event');
        Schema::dropIfExists('machine_calander_event_date');
    }
}
