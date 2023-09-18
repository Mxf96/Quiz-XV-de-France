<?php
require '../../managers/answers-manager.php';
require '../../../includes/inc-db-connect.php';
$answers = getAllAnswers($pdo);

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
    <div class="card">
        <h1 class="h1">Liste des Réponses</h1>
    </div>
    <a href="/admin/menu.php" class="back-button">Retour</a>
    <a href="/admin/crud/answers/new.php" >Ajouter une nouvelle réponse</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Question ID</th>
                <th>Texte de la réponse</th>
                <th>Est correcte</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($answers as $answer) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($answer['id']); ?></td>
                    <td><?php echo htmlspecialchars($answer['question_id']); ?></td>
                    <td><?php echo htmlspecialchars($answer['answer_text']); ?></td>
                    <td><?php echo htmlspecialchars($answer['is_correct']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlspecialchars($answer['id']); ?>" class="action-btn">Modifier</a> |
                        <a href="delete.php?id=<?= htmlspecialchars($answer['id']) ?>" class="action-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse?');">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>