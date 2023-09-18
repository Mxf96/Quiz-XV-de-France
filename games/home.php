<?php
require '../includes/inc-db-connect.php';

$scores = [];
try {
    $query = "SELECT u.firstname, us.score, us.date_scored 
          FROM users u 
          JOIN user_scores us ON u.id = us.user_id 
          ORDER BY us.score DESC 
          LIMIT 10";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $scores = $stmt->fetchAll();
} catch (PDOException $e) {
    die('Erreur lors de la récupération des scores : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil du Quiz</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>

    <h2>Bienvenue sur notre Quiz !</h2>

    <div class="container">
        <button  onclick="location.href='play.php'">Jouer</button>
        <a href="/logout/logout.php" class="logout" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">Déconnexion</a>
        <h3>Top 10 des scores</h3>
        <table>
            <thead>
                <tr>
                    <th>Player name</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scores as $score) : ?>
                    <tr>
                        <td><?= htmlspecialchars($score['firstname']) ?></td>
                        <td><?= $score['score'] ?> / 10</td>
                        <td><?= $score['date_scored'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<footer class="footer">
    <p>&copy; 2023 Rugby World Cup. All rights reserved.</p>
</footer>
</body>
</html>
