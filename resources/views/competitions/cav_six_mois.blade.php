@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Participations des cavaliers sur les six derniers mois</h2>

    <canvas id="lineChart"></canvas>

    <div class="mt-4">
        <h3>Liste des cavaliers ayant participé</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Nom du Cavalier</th>
                </tr>
            </thead>
            <tbody id="cavaliers-list">
        
        </tbody>
        </table>
    </div>
</div>

<script>
    // Récupérer les données PHP et les transformer en JavaScript
    let dataFromPHP = @json($cavaliers);

    // Organiser les données par mois (et année)
    let months = [];
    let participationsData = [];
    let participationDetails = [];
    
    // Créer un objet pour stocker les participations par mois
    let participationsPerMonth = {};

    // Remplir le tableau avec les participations pour chaque mois et année
    dataFromPHP.forEach(entry => {
        let date = new Date(entry.date_compet);
        let monthYear = `${date.getMonth() + 1}-${date.getFullYear()}`;  // "MM-YYYY"

        // Si ce mois n'est pas encore dans l'objet, on l'initialise
        if (!participationsPerMonth[monthYear]) {
            participationsPerMonth[monthYear] = [];
            months.push(monthYear);
        }

        // Ajouter un cavalier pour ce mois
        participationsPerMonth[monthYear].push(entry.prenom_caval + ' ' + entry.nom_caval);

        // Ajouter les détails des participations pour le tableau
        participationDetails.push({
            date: monthYear,
            cavalier: entry.prenom_caval + ' ' + entry.nom_caval
        });
    });

    // Trier les mois par ordre chronologique
    months.sort((a, b) => {
        return new Date(a) - new Date(b);
    });

    // Remplir les données de participations
    months.forEach(month => {
        participationsData.push(participationsPerMonth[month].length);
    });

    // Dessiner le Line Chart (Graphique Linéaire)
    let ctx = document.getElementById('lineChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months, // Mois sur l'axe des X
            datasets: [{
                label: 'Nombre de participations',
                data: participationsData, // Nombre de participations par mois
                borderColor: 'rgba(75, 192, 192, 1)', // Couleur de la ligne
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur de fond de la ligne
                fill: true,  // Remplir sous la ligne
                tension: 0.1  // Tension de la ligne (rend la courbe plus lisse)
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Mois'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Nombre de participations'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    // Insérer les cavaliers dans le tableau sous le graphique
    const cavaliersList = document.getElementById('cavaliers-list');
    participationDetails.forEach(participation => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${participation.date}</td><td>${participation.cavalier}</td>`;
        cavaliersList.appendChild(row);
    });
</script>

@endsection
