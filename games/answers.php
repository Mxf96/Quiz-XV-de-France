<?php
include '../includes/inc-db-connect.php';

$stmt = $pdo->prepare("SELECT * FROM questions");
$stmt->execute();
$questions = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réponses du Quiz</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>

<h2>Réponses du Quiz</h2>
<a href="home.php ">Retourner à l'accueil</a>
<div class="card">
    <ul class="answer-list">
        <?php foreach ($questions as $question): ?>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ? AND is_correct = 1");
            $stmt->execute([$question['id']]);
            $correctAnswer = $stmt->fetch();
            ?>
            <li class="answer-item">
                <strong>Question :</strong> <?php echo $question['title']; ?><br>
                <strong>Réponse correcte :</strong> <?php echo $correctAnswer['answer_text']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
