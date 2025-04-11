@extends('layouts.app')

@section('content')
    <h1>Tableau de bord de l'administrateur</h1>

    <h2>Demandes d'inscription en attente</h2>

    <!-- Affichage des messages de succès -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach($newRegistrations as $user)
            <li>
                {{ $user->name }} ({{ $user->email }})

                <!-- Formulaire pour valider l'utilisateur -->
                <form action="{{ route('admin.approve', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit">Valider</button>
                </form>

                <!-- Formulaire pour refuser l'utilisateur -->
                <form action="{{ route('admin.reject', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit">Refuser</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

