<?php
require '../../managers/users-manager.php';
require '../../../includes/inc-db-connect.php';
$users = getAllUsers($pdo);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire des Utilisateurs</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <div class="card">
        <h1 class="h1">Liste des Utilisateurs</h1>
    </div>
    <a href="/admin/menu.php" class="back-button">Retour</a>
    <a href="/admin/crud/users/new.php">Ajouter un nouvel utilisateur</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Mot de passe</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="action-btn">Modifier</a> |
                        <a href="delete.php?id=<?= htmlspecialchars($user['id']) ?>" class="action-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>