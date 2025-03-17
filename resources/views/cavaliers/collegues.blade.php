@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Mes collègues cavaliers</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cavaliers as $cavalier)
                    <tr>
                        <td>{{ $cavalier->nom_caval }}</td>
                        <td>{{ $cavalier->prenom_caval }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
