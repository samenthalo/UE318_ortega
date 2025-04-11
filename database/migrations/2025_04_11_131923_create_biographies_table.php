<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiographiesTable extends Migration
{
    public function up()
    {
        Schema::create('biographies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membre_id'); // Clé étrangère vers la table membres
            $table->text('biographie')->nullable(); // Texte de la biographie
            $table->timestamps();

            // Ajouter la contrainte de clé étrangère
            $table->foreign('membre_id')->references('id')->on('membres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('biographies');
    }
}

