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
        // Suppression des valeurs par défaut
        $table->string('nom');
        $table->string('prenom');
        $table->string('adresse');
    });
}
/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::table('membres', function (Blueprint $table) {
//
});
}
};
