<?php
require '../../managers/answers-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$answer = getAnswersById($pdo, $id);
$questions = getAllQuestions($pdo);

if ($_POST) {
    $question_id = intval($_POST['question_id']);
    $answer_text = strip_tags(trim($_POST['answer_text']));
    $is_correct = isset($_POST['is_correct']) ? 1 : 0;

    updateAnswers($pdo, $id, $question_id, $answer_text, $is_correct);
    header('Location: index.php');
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
            <h1>Modifier la réponse</h1>
            <form action="" method="post">
                <div class="input-group">
                    <label>Question ID: </label>
                    <select name="question_id">
                        <?php foreach ($questions as $question) : ?>
                            <option value="<?= $question['id'] ?>" <?php if ($question['id'] == $answer['question_id']) echo 'selected'; ?>>
                                <?= $question['title'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group">
                    <label>Texte de la réponse: </label>
                    <input type="text" name="answer_text" value="<?php echo htmlspecialchars($answer['answer_text']); ?>">
                </div>
                <div class="input-group">
                    <label>Est correcte: </label>
                    <input type="checkbox" name="is_correct" value="1" <?php if ($answer['is_correct']) echo 'checked'; ?>>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
</body>

</html>