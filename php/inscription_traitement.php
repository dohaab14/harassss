<?php

include("connectbdd.php");

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Valider les données du formulaire
    if (empty($nom) || empty($email) || empty($password) || empty($role)) {
        // Afficher un message d'erreur si des champs sont vides
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Insérer les données dans la base de données
    $requete = "INSERT INTO Utilisateurs (nom, adresse_email, password, role) VALUES ('$nom', '$email', '$password', $role)";
    $resultat = mysqli_query($connexion, $requete);

    $sql = "CREATE USER '$nom'@'localhost' IDENTIFIED BY '$password'";
    $res = mysqli_query($connexion, $sql);
    // à modifier en fonction des différents droits entre veterinaire et organisateur
    $sql1 = "GRANT DELETE,SELECT ON *.* TO '$nom'@'localhost'";
    $res1 = mysqli_query($connexion, $sql1);
    
    if ($resultat) {
        // Rediriger vers la page de connexion après l'inscription réussie
        header('Location: connexion.php');
        exit();
    } else {
        // Afficher un message d'erreur en cas d'échec de l'inscription
        echo "Une erreur s'est produite lors de l'inscription.";
    }
}

mysqli_close($connexion);
?>