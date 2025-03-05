<?php
include("connectbdd.php");

// Traitement du formulaire de connexion

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validez les données du formulaire

    if (empty($email) || empty($password)) {
        // Afficher un message d'erreur si des champs sont vides
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Recherchez l'utilisateur dans la base de données
    $requete = "SELECT * FROM Utilisateurs WHERE adresse_email = '$email'";
    $resultat = mysqli_query($connexion, $requete);

    // Vérifiez si l'utilisateur existe
    if (mysqli_num_rows($resultat) === 1) {
        $utilisateur = mysqli_fetch_assoc($resultat);

        // Vérifiez si le mot de passe correspond
        if ($password === $utilisateur['mdp']) {
            // Authentification réussie
            if ($utilisateur['role'] == 'veterinaire') {

                // Redirection vers la page réservée aux veto

                header('Location: page_veto.php');

            } else {

                // Redirection vers la page d'accueil pour les utilisateurs normaux

                header('Location: accueil.php');

            }
            exit();
        } else {
            // Mot de passe incorrect
            $erreur = 'Mot de passe incorrect.';
        }
    } else {
        // Utilisateur non trouvé
        $erreur = "L'utilisateur avec l'adresse e-mail $email n'existe pas.";
    }

    // Affichez les éventuelles erreurs
    if (isset($erreur)) {
        echo $erreur;
    }
}

mysqli_close($connexion);
?>
