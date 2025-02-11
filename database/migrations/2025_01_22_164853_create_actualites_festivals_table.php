<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualitesFestivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualites_festivals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_actualite');
            $table->unsignedBigInteger('id_festival');
            $table->foreign('id_actualite')->references('id')->on('actualites')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_festival')->references('id')->on('festivals')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('actualites_festivals');
    }
}
