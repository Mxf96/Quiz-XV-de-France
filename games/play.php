<?php
session_start();
include '../includes/inc-db-connect.php';

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

if (!isset($_SESSION['asked_questions'])) {
    $_SESSION['asked_questions'] = array();
}

$totalQuestions = 10;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <div class="info-box">
        <?php
        if (isset($_POST['answer'])) {
            $answerId = $_POST['answer'];

            $stmt = $pdo->prepare("SELECT is_correct FROM answers WHERE id = ?");
            $stmt->execute([$answerId]);
            $answer = $stmt->fetch();

            if ($answer && $answer['is_correct'] == 1) {
                $_SESSION['score']++;
            }

            $currentQuestion = count($_SESSION['asked_questions']) + 1;

            if ($answer && $answer['is_correct'] == 1) {
                echo "Réponse correcte ! Nouveau score : " . $_SESSION['score'] . "<br>";
            } else {
                echo "Réponse incorrecte ou absence d'identification du compte.<br>";
            }
        } else {
            $currentQuestion = 1;
            echo "Début du quiz.<br>";
        }

        if ($currentQuestion > $totalQuestions) {
            $finished = true;
            unset($_SESSION['asked_questions']);

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $stmt = $pdo->prepare("INSERT INTO user_scores (user_id, score) VALUES (?, ?)");
                $stmt->execute([$userId, $_SESSION['score']]);
                $finalScore = $_SESSION['score'];
                unset($_SESSION['score']);
            } else {
                echo '<div class="error">Erreur: Votre session a expiré. Veuillez vous reconnecter.</div>';
            }
        } else {
            $query = "SELECT * FROM questions";
            if (!empty($_SESSION['asked_questions'])) {
                $placeholders = implode(',', array_fill(0, count($_SESSION['asked_questions']), '?'));
                $query .= " WHERE id NOT IN ($placeholders) ORDER BY RAND() LIMIT 1";
            } else {
                $query .= " ORDER BY RAND() LIMIT 1";
            }
            $stmt = $pdo->prepare($query);
            $stmt->execute($_SESSION['asked_questions']);
            $question = $stmt->fetch();

            if (!$question) {
                die("Toutes les questions ont été posées.");
            } else {
                $_SESSION['asked_questions'][] = $question['id'];

                $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
                $stmt->execute([$question['id']]);
                $answers = $stmt->fetchAll();
            }
        }
        ?>
    </div>
    <?php if (isset($finished) && $finished) : ?>
        <div class="card">
            <h2>Quiz terminé !</h2>
            <p>Votre score est : <?php echo $finalScore; ?> sur 10</p>
            <a href="/games/answers.php">Voir les réponses</a>
            <a href="home.php ">Retourner à l'accueil</a>
        </div>
    <?php else : ?>
        <a href="home.php " class="back">Retour</a>
        <div class="card">
            <h2>Question <?php echo $currentQuestion; ?> sur 10</h2>
            <img class="image_size" src="/admin/assets/image_path/<?php echo $question['image_path']; ?>" alt="Image Question">
            <p><?php echo $question['title']; ?></p>
            <form action="play.php" method="post" class="question-form">
                <div class="buttons-grid">
                    <?php foreach ($answers as $answer) : ?>
                        <div>
                            <input type="radio" id="answer_<?php echo $answer['id']; ?>" name="answer" value="<?php echo $answer['id']; ?>">
                            <label for="answer_<?php echo $answer['id']; ?>" class="answer-btn"><?php echo $answer['answer_text']; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="submit-container">
                    <input type="submit" value="Valider">
                </div>
            </form>
        </div>
    <?php endif; ?>
</body>

</html>