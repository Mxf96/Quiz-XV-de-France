<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="/assets/css/styles.css">
    </head>

    <body>

        <h2>Inscription</h2>
        <a href="/index.html" class="btn back">Retour</a>
        <!-- Affichage des erreurs ici -->
        <?php
        if (isset($_GET["error"])) {
            echo '<p style="color: red;">' . nl2br(htmlspecialchars(isset($_GET["error"]) ? htmlspecialchars($_GET["error"]) : "")) . '</p>';
        }
        ?>
        
        <div class="container">
            <form action="register-POST.php" method="post">
                <div>
                    <label for="firstname">Prénom:</label>
                    <input type="text" id="firstname" name="firstname">
                </div>
                <div>
                    <label for="lastname">Nom:</label>
                    <input type="text" id="lastname" name="lastname">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div>
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password">
                </div>
                <div>
                    <label for="confirm_password">Confirmer le mot de passe:</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>
                <div class="button-group">
                    <button type="submit" >S'inscrire</button>
                </div>
            </form>
        </div>
    <footer class="footer">
    <p>&copy; 2023 Rugby World Cup. All rights reserved.</p>
</footer>
</body>
</html>
