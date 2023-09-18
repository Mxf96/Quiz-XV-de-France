<?php
require '../../managers/users-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$user = getUsersById($pdo, $id);
$roles = getAllRoles($pdo);
$current_role = getUserRole($pdo, $id);


if ($_POST) {
    $firstname = strip_tags(trim($_POST['firstname']));
    $lastname = strip_tags(trim($_POST['lastname']));
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));

    updateUsers($pdo, $id, $firstname, $lastname, $email, $password);
    
$role_id = $_POST['role'];
updateUserRole($pdo, $id, $role_id);

header('Location: index.php');
}


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
            <h1>Modifier l'utilisateur</h1>
            <form action="" method="post">
                <div class="input-group">
                    <label>Prénom: </label>
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>">
                </div>
                <div class="input-group">
                    <label>Nom: </label>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>">
                </div>
                <div class="input-group">
                    <label>Email: </label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div class="input-group">
                    <label>Mot de passe: </label>
                    <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>">
                </div>
                
<div class="input-group">
    <label>Role: </label>
    <select name="role">
        <?php foreach ($roles as $role) { ?>
            <option value="<?php echo $role['id']; ?>" <?php echo $current_role['labels'] == $role['labels'] ? 'selected' : ''; ?>><?php echo $role['labels']; ?></option>
        <?php } ?>
    </select>
</div>

<button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
</body>

</html>