<?php
require '../../managers/questions-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$question = getQuestionsById($pdo, $id);

if ($_POST) {
    $title = strip_tags(trim($_POST['title']));
    $image_path = strip_tags(trim($_POST['image_path']));

    updateQuestions($pdo, $id, $title, $image_path);
    header('Location: index.php');
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
            <h1>Modifier la question</h1>
            <form action="" method="post">
                <div class="input-group">
                    <label>Titre: </label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($question['title']); ?>">
                </div>
                <div class="input-group">
                    <label>Chemin de l'image: </label>
                    <input type="text" name="image_path" value="<?php echo htmlspecialchars($question['image_path']); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
</body>

</html>