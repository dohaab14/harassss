@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Mes informations</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Numéro de licence</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cavalier->nom_caval }}</td>
                    <td>{{ $cavalier->prenom_caval }}</td>
                    <td>{{ $cavalier->id_licence }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('cavalier.collegues') }}" class="btn btn-outline-secondary btn-sm card-btn-hover">Voir mes collègues</a>
    </div>
@endsection
