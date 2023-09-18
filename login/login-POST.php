<?php
require '../includes/inc-db-connect.php';

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = trim(strip_tags($_POST["email"] ?? ""));
    $password = trim(strip_tags($_POST["password"] ?? ""));

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        $stmt_role = $pdo->prepare("SELECT role_id FROM assign WHERE user_id = ?");
        $stmt_role->execute([$user['id']]);
        $role_data = $stmt_role->fetch();

        if ($role_data) {
            $role_id = $role_data['role_id'];
            if ($role_id == 1) {
                header('Location: /admin/menu.php');
                exit();
            } elseif ($role_id == 2) {
                header('Location: /games/home.php');
                exit();
            }
        } else {
            header("Location: login.php?error=Erreur lors de la récupération du rôle.");
            exit;
        }

    } else {
        header("Location: login.php?error=Erreur d'email ou de mot de passe.");
        exit;
    }
} else {
    header("Location: login.php?error=Veuillez remplir tous les champs.");
    exit;
}
