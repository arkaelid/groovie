<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModesTransportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modes_transport', function (Blueprint $table) {
            $table->id();
            $table->string('type', 128)->comment('Type de mode de transport');
            $table->integer('niveau')->nullable()->comment('Niveau du mode de transport');
            $table->integer('groovies')->nullable()->comment('Points groovies pour ce mode de transport');
            $table->decimal('empreinte_carbone', 15, 2)->nullable()->comment('Empreinte carbone du mode de transport');
            $table->string('caracteristique', 128)->nullable()->comment('Caractéristiques du mode de transport');
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
        Schema::dropIfExists('modes_transport');
    }
}
