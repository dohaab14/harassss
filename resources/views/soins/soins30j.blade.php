@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des soins vétérinaires (30 derniers jours)</h2>

    <div class="mb-4">
        <a href="{{ route('soins.index') }}" class="btn btn-outline-secondary  card-btn-hover">Retour à tous les soins</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nom du cheval</th>
                <th>Race</th>
                <th>Date du soin</th>
                <th>Nature du soin</th>
                <th>Vétérinaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($soins as $soin)
                <tr>
                    <td>{{ $soin->cheval->nom_cheval }}</td>
                    <td>{{ $soin->cheval->race }}</td>
                    <td>{{$soin->date_soin }}</td>
                    <td>{{ $soin->nature_soin }}</td>
                    <td>{{ $soin->veterinaire->nom_vet }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
