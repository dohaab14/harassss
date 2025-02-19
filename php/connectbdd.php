<?php
// Établir une connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "root";
$baseDeDonnees = "haras";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier si la connexion a échoué
if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}	
?>
