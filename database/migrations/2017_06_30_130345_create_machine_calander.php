<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineCalander extends Migration
{
    /**
     * Run the migrations.
     * TODO : trouver pk la migration plante
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_desc',function (Blueprint $table){
            $table->increments('id');
            $table->text('name');
            $table->mediumText('desc');

        });
        Schema::create('machine', function (Blueprint $table) {
            $table->increments('id');
            //0 - Imprimante 3d
            //1- poste a souder
            //2- poste de mecanique
            //3 - laser
            $table->integer('type')->unsigned();
            $table->mediumText('desc');

            $table->string('name')->default('default name');
            $table->boolean('supervision')->default(true);
            $table->integer('pointcost')->unsigned()->default(0)->comment('number of points used by a user to reserve one machine calander slot');
            $table->foreign('type')->references('id')->on('type_desc');

        });

        Schema::create('machine_reservation', function (Blueprint $table) {
            //id de l'utilisateur qui a reserver la machine
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->mediumText('description');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('machine_calander_status', function (Blueprint $table) {
            $table->increments('id');
            //le jour concerner par ce creaux
            $table->dateTime('date');
            //l'heur de debut du creneau , les creneaux sont
            //touses de 30 minutes
            //le statu du creneaux - 0 - pas dissponible
            // 1 - dissponible
            //2 -  reserver
            $table->integer('status')->default(0);
            //cle secondaire vers la reservation si elle existe
            $table->integer('reservation')->unsigned()->index()->nullable();
            $table->integer('machine_id')->unsigned();
            $table->foreign('machine_id' )->references('id')->on('machine')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reservation')->references('id')->on('machine_reservation')->onDelete('set null')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_desc');
        Schema::dropIfExists('machine_reservation');

        Schema::dropIfExists('machine_calander_status');

        Schema::dropIfExists('machine');

    }
}
