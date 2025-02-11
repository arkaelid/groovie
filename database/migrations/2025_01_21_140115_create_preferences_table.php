<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_festival')->nullable();
            $table->unsignedBigInteger('id_utilisateur');
            $table->unsignedBigInteger('id_mode_transport')->nullable();
            $table->foreign('id_festival')
            ->references('id')
            ->on('festivals')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_utilisateur')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_mode_transport')
            ->references('id')
            ->on('modes_transport')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('ville_depart')->nullable()->comment('ville de départ de préférence');
            $table->dateTime('date_depart')->nullable()->comment('Date de départ de préférence');
            $table->dateTime('date_retour')->nullable()->comment('Date de retour de préférence');
            $table->enum('type', ['Rock', 'Rap', 'Electro'])->nullable()->comment('Types de festival');
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
        Schema::dropIfExists('preferences');
    }
}
