<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_list', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('event_id')->references('id')->on('event');
            $table->timestamp('reservation_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_list');
    }
}
