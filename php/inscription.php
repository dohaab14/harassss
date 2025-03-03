<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form method="POST" action="inscription_traitement.php">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br>

        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required><br>

        <label for="role">role :</label>
        <input type="text" name="role" required><br>

        <input type="submit" value="Inscription">
    </form>
</body>
</html>
