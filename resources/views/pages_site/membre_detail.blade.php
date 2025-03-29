@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails du membre</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>Nom :</strong> {{ $membre->nom }}</li>
        <li class="list-group-item"><strong>Email :</strong> {{ Auth::check() ? $membre->email : '******' }}</li>
    </ul>

    @if(Auth::check() && Auth::id() === $membre->user_id)
        <a href="{{ route('membres.edit', $membre->id) }}" class="btn btn-warning mt-3">Modifier</a>
        <form action="{{ route('membres.destroy', $membre->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
        </form>
    @endif
</div>
@endsection

