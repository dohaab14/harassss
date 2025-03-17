@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Compétitions & Statistiques</h1>
    <p class="text-center mb-5">Retrouvez toutes les statistiques des compétitions.</p>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">Nos cavaliers  <span class="badge bg-primary">Nouveau</span></h5>
                    <p class="card-text mb-4">Liste des cavaliers ayant participé aux compétitions récemment</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('competitions.cavaliers') }}" class="btn btn-outline-secondary btn-lg card-btn-hover">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">Moyenne de compétitions par cheval <span class="badge bg-warning">2025</span></h5>
                    <p class="card-text mb-4">Nombre moyen de compétitions par cheval en 2025</p>
                    <div class="d-grid gap-2">
                    <a href="{{ route('competitions.moyenne') }}"  class="btn btn-outline-secondary btn-lg card-btn-hover">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">Villes & Victoires <span class="badge bg-success">Top</span></h5>
                    <p class="card-text mb-4">Voir les villes où les chevaux ont gagné</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('competitions.victoires') }}" class="btn btn-outline-secondary btn-lg card-btn-hover">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

