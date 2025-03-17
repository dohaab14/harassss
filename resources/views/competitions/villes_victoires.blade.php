@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Villes ayant vu un cheval arriver en tête</h2>
    
    <div class="mt-4">
        <h4 class="text-center">Tableau des victoires par cheval et ville</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom du cheval</th>
                    <th>Ville</th>
                    <th>Nombre de compétitions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($villes as $ville)
                    <tr>
                        <td>{{ $ville->nom_cheval }}</td>
                        <td>{{ $ville->nom_ville }}</td>
                        <td>{{ $ville->nombre_competition }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        <h4 class="text-center">Graphiques des victoires</h4>
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-center">Victoires des chevaux par ville</h5>
                <canvas id="barChart"></canvas>
            </div>

            <div class="col-md-6">
                <h5 class="text-center">Victoires totales des chevaux</h5>
                <canvas id="horizontalBarChart"></canvas>
            </div>
        </div>
    </div>

    <div class="alert alert-light mt-4" role="alert">
        Vous pouvez consulter <a href="{{ route('palmares.index') }}" class="alert-link">la liste complète de nos palmarès</a> pour plus de détails sur les victoires des chevaux par ville
    </div>
</div>

<script>
    // Récupérer les données PHP et les transformer en JavaScript
    let dataFromPHP = @json($villes);

    // Pour le graphique en barre (victoires par cheval et par ville)
    let villes = {};
    
    // Organiser les données par ville
    dataFromPHP.forEach(entry => {
        if (!villes[entry.nom_ville]) {
            villes[entry.nom_ville] = {};
        }
        villes[entry.nom_ville][entry.nom_cheval] = entry.nombre_competition;
    });

    let villesLabels = Object.keys(villes);
    let chevauxLabels = [...new Set(dataFromPHP.map(e => e.nom_cheval))];

    let barDatasets = chevauxLabels.map(cheval => ({
        label: cheval,
        data: villesLabels.map(ville => villes[ville][cheval] || 0),
        backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`,
        borderWidth: 1
    }));

    // Dessiner le graphique en barre (Bar Chart)
    let barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: villesLabels,
            datasets: barDatasets
        },
        options: {
            responsive: true,
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            },
            plugins: {
                legend: { position: 'top' }
            }
        }
    });

    // Pour le graphique à barres horizontales (victoires par cheval)
    let chevauxVictoires = {};
    
    // Organiser les données par cheval et totaliser les victoires pour chaque cheval
    dataFromPHP.forEach(entry => {
        if (!chevauxVictoires[entry.nom_cheval]) {
            chevauxVictoires[entry.nom_cheval] = 0;
        }
        chevauxVictoires[entry.nom_cheval] += entry.nombre_competition;
    });

    // Labels des chevaux
    let chevauxLabelsBar = Object.keys(chevauxVictoires);
    
    // Données des victoires par cheval
    let chevauxDataBar = Object.values(chevauxVictoires);

    // Dessiner le graphique à barres horizontales (Horizontal Bar Chart)
    let barHorizCtx = document.getElementById('horizontalBarChart').getContext('2d');
    new Chart(barHorizCtx, {
        type: 'bar',  // Type du graphique : barres horizontales
        data: {
            labels: chevauxLabelsBar,
            datasets: [{
                label: 'Victoires par Cheval',
                data: chevauxDataBar,
                backgroundColor: chevauxLabelsBar.map(() => `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',  // Permet d'afficher les barres horizontalement
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>

@endsection
