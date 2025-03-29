@extends('layouts.app')

@section('entete')
<!-- Contenu spécifique à l'entête -->
@stop

@section('titre')
Ceci est un exemple de page
@stop

@section('titre_contenu')
@foreach ($les_membres as $membre)
    <div class="membre">
        <h3 style="color: black;">
            {{ $membre->prenom }} {{ $membre->nom }}
        </h3>

        <!-- Afficher l'adresse uniquement si l'utilisateur est connecté -->
        @auth
            <div class="adresse" style="color: black;">
                {{ $membre->adresse }}
            </div>
        @endauth

    </div>
@endforeach
@stop

@section('pied_page')
LP3MI 2025
@stop

<!-- Inclure fond.blade.php avant le contenu -->
@include('pages_site.fond')

