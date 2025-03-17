<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haras</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Haras</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/chevaux') }}">Chevaux</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/competitions') }}">Compétitions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/palmares') }}">Palmarès</a>
                    </li>
                    
                    @if(auth()->check() && auth()->user()->isVeterinaire())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/soins') }}">Soins</a>
                    </li>
                    @endif

                    @if(auth()->check() && auth()->user()->isEntraineur())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/soins-entraineur') }}">Voir les soins actuels</a>
                    </li>
                    @endif
                </ul>
                

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                                Déconnexion
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content') 
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
