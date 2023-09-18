<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/questions-manager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = strip_tags(trim(htmlspecialchars($_POST['title'])));
    $image_path = strip_tags(trim(htmlspecialchars($_POST['image_path'])));

    insertQuestions($pdo, $title, $image_path);

    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire des Questions</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <a href="/admin/crud/questions/index.php" class="btn btn-info btn-block">Retour</a>
            <h1>Ajouter une nouvelle question</h1>
            <form action="" method="post">
                <div class="input-group">
                    <label>Titre: </label>
                    <input type="text" name="title">
                </div>
                <div class="input-group">
                    <label>Chemin de l'image: </label>
                    <input type="text" name="image_path">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</body>

</html>