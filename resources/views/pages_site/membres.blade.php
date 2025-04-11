@extends('layouts.app')

@section('content')
    <!-- Affichage des membres -->
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

                <!-- Affichage de la biographie si elle existe -->
                @if($membre->biographie)
                    <div class="biographie" style="color: black;">
                        <strong>Biographie :</strong>
                        <p>{{ $membre->biographie->biographie }}</p>
                    </div>
                @else
                    <div class="biographie" style="color: black;">
                        <strong>Biographie :</strong>
                        <p>Aucune biographie disponible.</p>
                    </div>
                @endif
            @endauth
        </div>
    @endforeach
@stop

@section('pied_page')
    LP3MI 2025
@stop

