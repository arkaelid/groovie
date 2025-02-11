<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->comment('Prénom de l\'utilisateur');
            $table->string('lastname')->comment('Nom de l\'utilisateur');
            $table->string('email')->unique();
            $table->string('id_groover')->unique()->comment('Identifiant groover');
            $table->string('pseudo')->nullable()->unique()->comment('Pseudonyme de l\'utilisateur');
            $table->string('role')->comment('Rôle de l\'utilisateur');
            $table->enum('etat', ['disponible', 'suspendu', 'supprime'])->comment('État de l\'utilisateur');
            $table->string('ville')->nullable()->comment('Ville de l\'utilisateur');
            $table->integer('experience')->nullable()->comment('Expérience de l\'utilisateur.');
            $table->integer('groovies')->nullable()->comment('Points groovies de l\'utilisateur.');            
            $table->string('qrcode')->nullable()->unique()->comment('QR Code de l\'utilisateur');
            $table->string('avatar')->nullable()->comment('Avatar de l\'utilisateur');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
