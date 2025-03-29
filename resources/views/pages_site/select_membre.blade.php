@extends('layouts.app')

@section('content')
    <h1>Choisir un membre à modifier</h1>

    <ul>
        @foreach ($membres as $membre)
            <li>
                <!-- Affichage du nom, prénom et du bouton de modification -->
                <span>{{ $membre->nom }} {{ $membre->prenom }}</span>
                <button onclick="toggleEditForm({{ $membre->id }})">Modifier</button>

                <!-- Formulaire de modification caché par défaut -->
                <div id="edit-form-{{ $membre->id }}" style="display: none;">
                    <form action="{{ route('membres.update', $membre->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Champs du formulaire avec les données pré-remplies -->
                        <label for="nom">Nom:</label>
                        <input type="text" name="nom" value="{{ $membre->nom }}" required>

                        <label for="prenom">Prénom:</label>
                        <input type="text" name="prenom" value="{{ $membre->prenom }}" required>

                        <label for="adresse">Adresse:</label>
                        <input type="text" name="adresse" value="{{ $membre->adresse }}" required>

                        <button type="submit">Mettre à jour</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Script pour afficher/masquer le formulaire -->
    <script>
        function toggleEditForm(id) {
            var form = document.getElementById('edit-form-' + id);
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
@endsection

