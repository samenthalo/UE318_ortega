@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier le membre : {{ $membre->prenom }} {{ $membre->nom }}</h2>

        <form action="{{ route('membres.update', $membre->id) }}" method="POST" onsubmit="console.log('Formulaire envoyé !')">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $membre->prenom) }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $membre->nom) }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $membre->adresse) }}" required class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection

