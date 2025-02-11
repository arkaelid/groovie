<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalOffreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_offre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_festival');
            $table->unsignedBigInteger('id_offre');
            $table->foreign('id_festival')
            ->references('id')
            ->on('festivals')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_offre')
            ->references('id')
            ->on('offres')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('festival_offre');
    }
}
