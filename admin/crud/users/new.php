<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/users-manager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = strip_tags(trim(htmlspecialchars($_POST['firstname'])));
    $lastname = strip_tags(trim(htmlspecialchars($_POST['lastname'])));
    $email = strip_tags(trim(htmlspecialchars($_POST['email'])));
    $password = strip_tags(trim(htmlspecialchars($_POST['password'])));

    insertUsers($pdo, $firstname, $lastname, $email, $password);

    
$role_id = $_POST['role'];
$last_user_id = $pdo->lastInsertId();
assignUserRole($pdo, $last_user_id, $role_id);

header("Location: index.php");
    exit();
}

$roles = getAllRoles($pdo);

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
    <div class="container">
        <div class="login-box">
            <a href="/admin/crud/users/index.php" class="btn btn-info btn-block">Retour</a>
            <h1>Ajouter un nouvel utilisateur</h1>
            <form action="" method="post">
                <div class="input-group">
                    <label>Prénom: </label>
                    <input type="text" name="firstname">
                </div>
                <div class="input-group">
                    <label>Nom: </label>
                    <input type="text" name="lastname">
                </div>
                <div class="input-group">
                    <label>Email: </label>
                    <input type="email" name="email">
                </div>
                <div class="input-group">
                    <label>Mot de passe: </label>
                    <input type="password" name="password">
                </div>
                
<div class="input-group">
    <label>Role: </label>
    <select name="role">
        <?php foreach ($roles as $role) { ?>
            <option value="<?php echo $role['id']; ?>"><?php echo $role['labels']; ?></option>
        <?php } ?>
    </select>
</div>

<button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</body>

</html>