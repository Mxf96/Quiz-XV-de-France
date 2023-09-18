<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/answers-manager.php';
require '../../managers/questions-manager.php';

$questions = getAllQuestions($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $question_id = intval($_POST['question_id']);
    $answer_text = strip_tags(trim(htmlspecialchars($_POST['answer_text'])));
    $is_correct = isset($_POST['is_correct']) ? 1 : 0;

    insertAnswers($pdo, $question_id, $answer_text, $is_correct);

    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire des Réponses</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <a href="/admin/crud/answers/index.php" class="btn btn-info btn-block">Retour</a>
            <h1>Ajouter une nouvelle réponse</h1>
            <form action="" method="post">
                <div class="input-group">
                    <label>Question ID: </label>
                    <select name="question_id">
                        <?php foreach ($questions as $question) : ?>
                            <option value="<?= $question['id'] ?>">
                                <?= $question['title'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group">
                    <label>Texte de la réponse: </label>
                    <input type="text" name="answer_text">
                </div>
                <div class="input-group">
                    <label>Est correcte: </label>
                    <input type="checkbox" name="is_correct" value="1">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</body>

</html>