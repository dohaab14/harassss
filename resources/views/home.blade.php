@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        @if(auth()->check())
            @if(auth()->user()->role == 'cavalier')
                <h2>Bienvenue,  {{ auth()->user()->nom }}</h2>
                <p class="lead">Gérez facilement les soins, les chevaux et les compétitions.</p>
            @elseif(auth()->user()->role == 'entraineur')
                <h2>Bienvenue, Entraîneur {{ auth()->user()->nom }}</h2>
                <p class="lead">Gérez les chevaux et les entraînements.</p>
            @elseif(auth()->user()->role == 'veterinaire')
                <h2>Bienvenue, Vétérinaire {{ auth()->user()->nom }}</h2>
                <p class="lead">Suivez les soins des chevaux et consultez leurs historiques médicaux.</p>
            @endif
        @else
            <h2>Bienvenue au Haras</h2>
            <p class="lead">Découvrez nos services et inscrivez-vous pour participer à nos activités.</p>
        @endif
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-4 d-flex">
            <div class="card shadow-lg w-100">
                <img src="{{ asset('images/aude_chev.jpg') }}" class="card-img-top" alt="Cheval">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">Nos Chevaux</h5>
                    <p class="card-text">Découvrez tous les chevaux et suivez leurs performances.</p>
                    <a href="{{ route('chevaux.index') }}" class="btn btn-primary mt-auto">Voir plus</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card shadow-lg w-100">
                <img src="{{ asset('images/competition.png') }}" class="card-img-top" alt="Compétition">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">Compétitions</h5>
                    <p class="card-text">Suivez les compétitions et nos résultats.</p>
                    <a href="{{ route('competitions.index') }}" class="btn btn-primary mt-auto">Voir plus</a>
                </div>
            </div>
        </div>

        @if(auth()->check() && auth()->user()->isVeterinaire())
        <div class="col-md-4 d-flex">
            <div class="card shadow-lg w-100">
                <img src="{{ asset('images/soins.png') }}" class="card-img-top" alt="Soins">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">Soins des chevaux</h5>
                    <p class="card-text">Gérez les soins et le suivi médical des chevaux.</p>
                    <a href="{{ route('soins.index') }}" class="btn btn-primary mt-auto">Voir plus</a>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->isEntraineur())
        <div class="col-md-4 d-flex">
            <div class="card shadow-lg w-100">
                <img src="{{ asset('images/soins.png') }}" class="card-img-top" alt="Soins">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">Soins des chevaux</h5>
                    <p class="card-text">Suivi médical des chevaux sous les 30 jours</p>
                    <a href="{{ route('soins.entraineur') }}" class="btn btn-primary mt-auto">Voir plus</a>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->isCavalier())
        <div class="col-md-4 d-flex">
            <div class="card shadow-lg w-100">
                <img src="{{ asset('images/soins.png') }}" class="card-img-top" alt="Soins">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">Mes informations</h5>
                    <p class="card-text">Juste comme ça pour dire que j'ai un droit en plus</p>
                    <a href="{{ route('cavaliers.info') }}" class="btn btn-primary mt-auto">Me consulter</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
