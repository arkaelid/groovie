<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['modification', 'suppression', 'Nouveauté'])->comment('Type de notification');
            $table->longText('description')->comment('Description de la notification');
            $table->unsignedBigInteger('id_festival')->nullable();
            $table->unsignedBigInteger('id_trajet')->nullable();
            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_festival')->references('id')->on('festivals')->onDelete('set null')->onUpdate('restrict');
            $table->foreign('id_trajet')->references('id')->on('trajets')->onDelete('set null')->onUpdate('restrict');
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('notifications');
    }
}
