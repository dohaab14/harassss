@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('competitions.moyenne') }}" method="GET" class="d-flex justify-content-center mb-4">
        <div class="form-group">
            <label for="year" class="d-none">Choisissez une année :</label>
            <select name="year" id="year" class="form-control form-control-sm" style="max-width: 200px;">
            <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>

                <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-primary btn-sm ml-2">Filtrer</button>
    </form>

    <h2 class="text-center">Nombre de compétitions par cheval en {{ $year }}</h2>

    <div class="mt-4">
        <canvas id="competitionsChart"></canvas>
    </div>

    <script>
        // Récupérer les données PHP dans un format utilisable par JavaScript
        var chevaux = @json(array_column($stats, 'nom_cheval'));
        var nombreCompetitions = @json(array_column($stats, 'nombre_competitions'));

        // Initialiser le graphique
        var ctx = document.getElementById('competitionsChart').getContext('2d');
        var competitionsChart = new Chart(ctx, {
            type: 'bar', // Type de graphique (barres)
            data: {
                labels: chevaux, // Les noms des chevaux
                datasets: [{
                    label: 'Nombre de compétitions',
                    data: nombreCompetitions, // Données des compétitions
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', // Couleur de fond des barres
                    borderColor: 'rgba(75, 192, 192, 1)', // Couleur des bordures des barres
                    borderWidth: 1 // Largeur de la bordure des barres
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true, // Commencer l'axe Y à zéro
                        title: {
                            display: true,
                            text: 'Nombre de compétitions' // Légende de l'axe Y
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Chevaux' // Légende de l'axe X
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top', // Position de la légende du graphique
                        labels: {
                            font: {
                                size: 14 // Taille de la police de la légende
                            }
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection
