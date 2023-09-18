<?php require '../includes/inc-db-connect.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>

    <h2>Connexion</h2>
    <a href="/index.html" class="btn back">Retour</a>
    <!-- Affichage des erreurs et des messages de succès ici -->
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red;">' . nl2br(htmlspecialchars($_GET['error'])) . '</p>';
    }
    if (isset($_GET['success'])) {
        echo '<p style="color: green;">' . nl2br(htmlspecialchars($_GET['success'])) . '</p>';
    }
    ?>

    <div class="container">
        <form action="login-POST.php" method="post">
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="button-group">
                <button type="submit" >Se connecter</button>
            </div>
        </form>
    </div>
<footer class="footer">
    <p>&copy; 2023 Rugby World Cup. All rights reserved.</p>
</footer>
</body>
</html>
