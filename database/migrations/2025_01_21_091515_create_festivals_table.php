<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->id(); // Colonne "id" en auto-incrément
            $table->string('nom_festival', 128)->comment('Nom du festival');
            $table->float('prix', 8, 2)->comment('Prix du festival');
            $table->string('slug', 128)->comment('Slug du festival');
            $table->string('lieu_festival', 255)->comment('Lieu du festival');
            $table->string('lien', 255)->nullable()->comment('Lien du festival');
            $table->dateTime('date_heure_debut')->comment('Date et heure de début du festival');
            $table->dateTime('date_heure_fin')->comment('Date et heure de fin du festival');
            $table->string('image_festival', 255)->comment('Image du festival');
            $table->enum('type', ['Rock', 'Rap', 'Electro'])->nullable()->comment('Types de festival');
            $table->string('id_api', 255)->nullable()->comment('ID du festival de l\'API');
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
        Schema::dropIfExists('festivals');
    }
}
