<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id(); // Identifiant de l'offre
            $table->string('nom_offre', 50); // Nom de l'offre
            $table->integer('points_groovie'); // Points Groovie de l'offre
            $table->integer('reduction_en_pourcentage'); // Réduction de l'offre
            $table->string('informations_offre', 512)->nullable(); // Informations supplémentaires
            $table->string('conditions_offre', 512); // Conditions de l'offre
            $table->timestamps(); // Colonnes 'created_at' et 'updated_at'
            $table->unsignedBigInteger('id_partenaire')->nullable();
            $table->string('image')->nullable();
            $table->foreign('id_partenaire')->references('id')->on('partenaires')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offres');
    }
}
