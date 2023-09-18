<?php
require '../../managers/questions-manager.php';
require '../../../includes/inc-db-connect.php';
$questions = getAllQuestions($pdo);

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
    <div class="card">
        <h1 class="h1">Liste des Questions</h1>
    </div>
    <a href="/admin/menu.php" class="back-button">Retour</a>
    <a href="/admin/crud/questions/new.php" >Ajouter une nouvelle question</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Chemin de l'image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($question['id']); ?></td>
                    <td><?php echo htmlspecialchars($question['title']); ?></td>
                    <td><?php echo htmlspecialchars($question['image_path']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlspecialchars($question['id']); ?>" class="action-btn">Modifier</a> |
                        <a href="delete.php?id=<?= htmlspecialchars($question['id']) ?>" class="action-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question?');">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>