<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Personnalisation du menu */
        .navbar {
            background-color: #6a0dad; /* Violet */
        }
        .navbar-brand, .nav-link {
            color: #fff !important; /* Texte en blanc */
        }
        .nav-link:hover {
            color: #e0aaff !important; /* Couleur du texte au survol */
        }
        .navbar-toggler-icon {
            background-color: #fff; /* Icone du toggle en blanc */
        }
    </style>

    <!-- Scripts (Bootstrap JS via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div id="app">

        <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{ url('/') }}">Gestion Club</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('membres.index') }}">Consultation des membres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('membres.create') }}">Ajouter un membre</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('membres.select') }}" class="nav-link">Modifier un membre</a>
            </li>

            @auth
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Tableau de bord Admin</a>
                    </li>
                @endif

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Se déconnecter</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">S'enregistrer</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

        <!-- Contenu de la page -->
        <main class="py-4">
            @yield('content') <!-- Ici, ton contenu spécifique à chaque page -->
        </main>

    </div>
</body>
</html>

