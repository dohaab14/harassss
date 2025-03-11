<?php

include("connectbdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
    $email = mysqli_real_escape_string($connexion, $_POST['email']);
    $password = mysqli_real_escape_string($connexion, $_POST['password']);
    $role = mysqli_real_escape_string($connexion, $_POST['role']);

    if (empty($nom) || empty($email) || empty($password) || empty($role)) {
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Hachage du mot de passe
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Récupérer le dernier id_utilisateur et l'incrémenter
    $query_id_user = "SELECT MAX(id_utilisateur) AS last_id FROM utilisateur";
    $result_id_user = mysqli_query($connexion, $query_id_user);
    $row_id_user = mysqli_fetch_assoc($result_id_user);
    $new_id_utilisateur = ($row_id_user['last_id'] !== null) ? $row_id_user['last_id'] + 1 : 1;

    // Déterminer la table concernée et le préfixe de l'ID spécifique
    $table = "";
    $colonne_id = "";
    $prefix = "";

    if ($role === "veterinaire") {
        $table = "veterinaire";
        $colonne_id = "id_vet";
        $prefix = "V";
    } elseif ($role === "entraineur") {
        $table = "entraineur";
        $colonne_id = "id_entraineur";
        $prefix = "E";
    } elseif ($role === "cavalier") {
        $table = "cavalier";
        $colonne_id = "id_licence";
        $prefix = "C";
    } else {
        echo "Rôle invalide. Merci d'entrer veterinaire, entraineur ou cavalier";
        exit();
    }

    // Récupérer le dernier ID existant de la table correspondante
    $query = "SELECT MAX(CAST(SUBSTRING($colonne_id, 2, 3) AS UNSIGNED)) AS last_id FROM $table";
    $result = mysqli_query($connexion, $query);
    $row = mysqli_fetch_assoc($result);
    $last_id = ($row['last_id'] !== null) ? intval($row['last_id']) : 0;

    // Générer le nouvel ID spécifique au rôle
    $new_id = $prefix . str_pad($last_id + 1, 3, '0', STR_PAD_LEFT);

    // 1️⃣ Insérer d'abord dans la table du rôle spécifique
    if ($role === "veterinaire") {
        $req_vet = "INSERT INTO veterinaire (id_vet, nom_vet, email) VALUES (?, ?, ?)";
        $stmt_vet = mysqli_prepare($connexion, $req_vet);
        mysqli_stmt_bind_param($stmt_vet, "sss", $new_id, $nom, $email);
        mysqli_stmt_execute($stmt_vet);
        mysqli_stmt_close($stmt_vet);
    } elseif ($role === "entraineur") {
        $req_entraineur = "INSERT INTO entraineur (id_entraineur, nom_entraineur, specialite, id_ville, nom_club) 
                           VALUES (?, ?, NULL, 1, 'Écuries de Versailles')"; // À adapter
        $stmt_entraineur = mysqli_prepare($connexion, $req_entraineur);
        mysqli_stmt_bind_param($stmt_entraineur, "ss", $new_id, $nom);
        mysqli_stmt_execute($stmt_entraineur);
        mysqli_stmt_close($stmt_entraineur);
    } elseif ($role === "cavalier") {
        $req_cavalier = "INSERT INTO cavalier (id_licence, nom_caval, prenom_caval) 
                         VALUES (?, ?, '')";  // Le prénom peut être ajouté plus tard
        $stmt_cavalier = mysqli_prepare($connexion, $req_cavalier);
        mysqli_stmt_bind_param($stmt_cavalier, "ss", $new_id, $nom);
        mysqli_stmt_execute($stmt_cavalier);
        mysqli_stmt_close($stmt_cavalier);
    }

    // 2️⃣ Maintenant, insérer l'utilisateur dans `utilisateur` avec le bon `id_utilisateur`
    $requete = "INSERT INTO utilisateur (id_utilisateur, nom, email, mdp, role, id_vet, id_entraineur, id_licence) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($connexion, $requete);

    // Définir les valeurs en fonction du rôle
    $id_vet = ($role === "veterinaire") ? $new_id : NULL;
    $id_entraineur = ($role === "entraineur") ? $new_id : NULL;
    $id_licence = ($role === "cavalier") ? $new_id : NULL;

    mysqli_stmt_bind_param($stmt, "isssssss", $new_id_utilisateur, $nom, $email, $password_hashed, $role, $id_vet, $id_entraineur, $id_licence);
    $resultat = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirection après inscription réussie
    if ($resultat) {
        header('Location: connexion.php');
        exit();
    } else {
        echo "Une erreur s'est produite lors de l'inscription.";
    }
}

mysqli_close($connexion);
?>
