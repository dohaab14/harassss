@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des soins vétérinaires de ce mois</h2>
  
    <table class = "table">
    <thead>
        <tr>
            <th>Nom du cheval</th>
            <th>Date du soin</th>
            <th>Nature du soin</th>
            <th>Nom du vétérinaire</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($soins as $soin)
            <tr>
            <td>{{ $soin->nom_cheval }}</td> <!-- Utilisation de la relation 'cheval' pour accéder au nom -->
                    <td>{{ $soin->date_soin }}</td>
                    <td>{{ $soin->nature_soin }}</td>
                    <td>{{ $soin->nom_vet }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
