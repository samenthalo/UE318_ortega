<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('membres', function (Blueprint $table) {
            $table->string('nom')->default(null)->change();
            $table->string('prenom')->default(null)->change();
            $table->string('adresse')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membres', function (Blueprint $table) {
            $table->string('nom')->default('valeur par défaut')->change();
            $table->string('prenom')->default('valeur par défaut')->change();
            $table->string('adresse')->default('valeur par défaut')->change();
        });
    }
};

