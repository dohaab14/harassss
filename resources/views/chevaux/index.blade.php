@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des chevaux</h2>

    <!-- Lien vers la page des chevaux par race et nombre de compétitions -->
    <div class="mb-4">
        <a href="{{ route('chevaux.compet') }}" class="btn btn-outline-secondary btn-lg card-btn-hover">Voir les chevaux classés par compétitions</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nom du cheval</th>
                <th>Race</th>
                <th>Nom du club</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chevaux as $cheval)
                <tr>
                    <td>{{ $cheval->nom_cheval }}</td>
                    <td>{{ $cheval->race }}</td>
                    <td>{{ $cheval->nom_club }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
