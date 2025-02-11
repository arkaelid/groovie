<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pauses', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->comment('Nom du point d\'intérêt');
            $table->string('adresse')->comment('Lieu du point d\'intérêt');
            $table->time('duree')->comment('Durée de la pause'); // Durée du trajet
            $table->unsignedBigInteger('id_trajet');
            $table->foreign('id_trajet')->references('id')->on('trajets')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pauses');
    }
}
