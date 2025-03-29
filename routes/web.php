<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonControleur;
use App\Http\Controllers\ControleurMembres;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BiographieController;

// Page d'accueil
// Redirection vers la page /home si la page d'accueil est visitée
Route::get('/', function () {
    return redirect()->route('home');
});

// Pages de test
Route::get('/hello', function () {
    echo '<h1>Bonjour !</h1>';
});

Route::get('/bonjour/{nom}', function ($nom) {
    echo "Bonjour " . ucfirst($nom);
});

// Routes générales
Route::get('nouvellepage', [MonControleur::class, 'retourneNouvellePage']);
Route::get('exemple', [MonControleur::class, 'retournePageExemple']);

// Routes pour la gestion des membres, sans middleware 'auth'
Route::get('/membres', [ControleurMembres::class, 'index'])->name('membres.index');

// Sélectionner un membre à modifier
Route::get('/membres/modify', [ControleurMembres::class, 'selectMembre'])->name('membres.select');

// Page de création d'un membre
Route::get('/membres/create', [ControleurMembres::class, 'create'])->name('membres.create');
Route::post('/membres', [ControleurMembres::class, 'store'])->name('membres.store');

// Affichage d'un membre spécifique
Route::get('/membres/{id}', [ControleurMembres::class, 'show'])->name('membres.show');

// Routes pour modifier et supprimer un membre, avec middleware 'can' pour les permissions spécifiques
Route::get('/membres/{id}/edit', [ControleurMembres::class, 'edit'])
    ->middleware('can:edit-member,id') // Autorisation spécifique pour modifier un membre
    ->name('membres.edit');
Route::put('/membres/{id}', [ControleurMembres::class, 'update'])->name('membres.update');

Route::delete('/membres/{id}', [ControleurMembres::class, 'destroy'])
    ->middleware('can:delete-member,id') // Autorisation spécifique pour supprimer un membre
    ->name('membres.destroy');

// Route de confirmation après opération sur un membre
Route::get('/confirmation/{operation}', [ControleurMembres::class, 'confirmation'])->name('confirmation');

// Routes de la biographie des membres
Route::middleware('auth')->group(function () {
    // Afficher la biographie d'un membre
    Route::get('/biographie/{id}', [BiographieController::class, 'show'])->name('biographie.show');
    // Mettre à jour ou ajouter une biographie d'un membre
    Route::post('/biographie/{id}', [BiographieController::class, 'store'])->name('biographie.store');
    Route::put('/biographie/{id}', [BiographieController::class, 'update'])->name('biographie.update');
});

// Authentification Laravel
Auth::routes();

// Redirection vers la page d'accueil après connexion
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Biographie
Route::put('/membres/{id}/biographie', [MembreController::class, 'updateBiographie'])->name('biographie.update');

