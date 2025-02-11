<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffreTrajetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offre_trajet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_offre');
            $table->unsignedBigInteger('id_trajet');
            $table->foreign('id_offre')->references('id')->on('offres')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('offre_trajet');
    }
}
