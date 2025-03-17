@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des soins vétérinaires</h2>
<br>
    <div class="mb-4">
        <a href="{{ route('soins.30j') }}" class="btn btn-outline-secondary  card-btn-hover">
            <i class="fas fa-calendar-day"></i> Voir les soins des 30 derniers jours
        </a>
        <a href="{{ route('soins.gerer') }}" class="btn btn-outline-success ">
            <i class="fas fa-plus-circle"></i> Ajouter un soin
        </a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nom du cheval</th>
                <th>Date du soin</th>
                <th>Nature du soin</th>
                <th>Vétérinaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($soins as $soin)
                <tr>
                    <td>{{ $soin->cheval->nom_cheval }}</td> <!-- Utilisation de la relation 'cheval' pour accéder au nom -->
                    <td>{{ $soin->date_soin }}</td>
                    <td>{{ $soin->nature_soin }}</td>
                    <td>{{ $soin->veterinaire->nom_vet }}</td>
                    <td>
                        <a href="{{ route('soins.modifier', $soin->id_soin) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <!-- @csrf : protection contre les injections malveillantes-->
                        <!-- @method('DELETE'):pour que Laravel sache qu'il s'agit d'une requête de suppression -->
                        <form action="{{ route('soins.supprimer', $soin->id_soin) }}" method="POST" style="display:inline;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce soin ?')">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
