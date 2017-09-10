<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlacklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blacklist', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->primary('user_id');
            $table->timestamps();
            $table->enum('chances',[0,1,2])->default(2)->comment('number of chances until user is definatly blacklisted');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blacklist');
    }
}
