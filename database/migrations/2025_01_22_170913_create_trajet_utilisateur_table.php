<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrajetUtilisateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trajet_utilisateur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trajet_id');
            $table->unsignedBigInteger('utilisateur_id');
            $table->foreign('trajet_id')->on('trajets')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('utilisateur_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type', ['reserve', 'enregistre'])->comment('Réservé / enregistré');
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
        Schema::dropIfExists('trajet_utilisateur');
    }
}
