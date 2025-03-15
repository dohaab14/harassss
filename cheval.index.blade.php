@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Liste des Chevaux et leurs Compétitions</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom du Cheval</th>
                <th>Race</th>
                <th>Nombre de Compétitions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chevaux as $cheval)
                <tr>
                    <td>{{ $cheval->nom_cheval }}</td>
                    <td>{{ $cheval->race }}</td> <!-- Affiche la race directement -->
                    <td>{{ $cheval->nb_compet }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
