<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrajetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trajets', function (Blueprint $table) {
            $table->id(); // Identifiant du trajet
            $table->string('nom', 128); // Nom du trajet
            $table->dateTime('date_heure'); // Date et heure du trajet
            $table->integer('groovies'); // Points groovies pour le trajet
            $table->string('lieu_depart', 128); // Lieu de départ
            $table->decimal('empreinte_carbone', 15, 2); // Empreinte carbone du trajet
            $table->time('duree'); // Durée du trajet
            $table->integer('distance')->nullable(); // Distance parcourue
            $table->integer('nb_personnes'); // Nombre de personnes
            $table->enum('type',['Aller', 'Retour'])->comment('aller ou retour');
            $table->decimal('prix', 5, 2)->comment('prix du trajet');
            $table->unsignedBigInteger('id_mode_transport');
            $table->unsignedBigInteger('id_festival');
            $table->foreign('id_mode_transport')
            ->references('id')->on('modes_transport')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_festival')
            ->references('id')->on('festivals')->onDelete('cascade')->onUpdate('cascade'); // Référence au festival
            $table->timestamps(); // Création des colonnes 'created_at' et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trajets');
    }
}
