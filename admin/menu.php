<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Admin</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
<a href="/logout/logout.php" class="logout" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">Déconnexion</a>
    <div class="card-menu">
        <h1>Menu d'administration</h1>
        <a href="/admin/crud/answers/index.php" class="btn btn-primary">Gérer les réponses</a>
        <a href="/admin/crud/questions/index.php" class="btn btn-primary">Gérer les questions</a>
        <a href="/admin/crud/users/index.php" class="btn btn-primary">Gérer les utilisateurs</a>
    </div>
</body>

</html>