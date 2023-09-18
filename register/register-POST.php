<?php
session_start();
require '../includes/inc-db-connect.php';

$firstname = trim(strip_tags($_POST["firstname"] ?? ""));
$lastname = trim(strip_tags($_POST["lastname"] ?? ""));
$email = trim(strip_tags($_POST["email"] ?? ""));
$password = trim(strip_tags($_POST["password"] ?? ""));
$confirm_password = trim($_POST['confirm_password'] ?? '');

$errors = [];

if (empty($firstname)) {
    $errors[] = "Veuillez remplir le prénom.";
}

if (empty($lastname)) {
    $errors[] = "Veuillez remplir le nom.";
}

if (empty($email)) {
    $errors[] = "Veuillez remplir l'email.";
}

if (empty($password)) {
    $errors[] = "Veuillez remplir le mot de passe.";
}

if (empty($confirm_password)) {
    $errors[] = "Veuillez confirmer le mot de passe.";
}

if ($password !== $confirm_password) {
    $errors[] = "Les mots de passe ne correspondent pas.";
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    header("Location: register.php");
    exit;
}

if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && isset($_POST['confirm_password'])) {

    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        header("Location: register.php?error=Les mots de passe ne correspondent pas.");
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        header("Location: register.php?error=Cet email est déjà associé à un compte.");
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([$firstname, $lastname, $email, $hashedPassword]);

        $last_user_id = $pdo->lastInsertId();
        $stmt_role = $pdo->prepare("INSERT INTO assign (user_id, role_id) VALUES (?, 2)");
        $stmt_role->execute([$last_user_id]);

        if ($result) {
            header("Location: ../login/login.php?success=Inscription réussie !");
            exit;
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
} else {
    header("Location: register.php?error=Veuillez remplir tous les champs.");
}
