@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des chevaux classés par nombre de compétitions disputées</h2>
    <div class="mb-4">
        <a href="{{ route('chevaux.index') }}" class="btn btn-outline-secondary btn-lg card-btn-hover">Voir nos chevaux </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nom du cheval</th>
                <th>Nombre de compétitions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chevauxCompetitions as $cheval)
                <tr>
                    <td>{{ $cheval->nom_cheval }}</td>
                    <td>{{ $cheval->compet_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
