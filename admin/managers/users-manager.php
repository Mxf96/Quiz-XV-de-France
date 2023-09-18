<?php
require '../../../includes/inc-db-connect.php';

function getAllUsers($pdo) {
    $query = 'SELECT * FROM users';
    $req = $pdo->prepare($query);
    $req->execute();
    return $req->fetchAll();
}

function getUsersById($pdo, $id) {
    $query = 'SELECT * FROM users WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}

function insertUsers($pdo, $firstname, $lastname, $email, $password) {
    $query = 'INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)';
    $req = $pdo->prepare($query);
    $req->bindParam(':firstname', $firstname);
    $req->bindParam(':lastname', $lastname);
    $req->bindParam(':email', $email);
    $req->bindParam(':password', $password);

    $req->execute();
}

function updateUsers($pdo, $id, $firstname, $lastname, $email, $password) {
    $query = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':firstname', $firstname);
    $req->bindParam(':lastname', $lastname);
    $req->bindParam(':email', $email);
    $req->bindParam(':password', $password);
    $req->bindParam(':id', $id, PDO::PARAM_INT);

    $req->execute();
}

function deleteUsers($pdo, $id) {
    $query = 'DELETE FROM users WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
}



function getAllRoles($pdo) {
    $query = 'SELECT * FROM roles';
    $req = $pdo->prepare($query);
    $req->execute();
    return $req->fetchAll();
}

function getUserRole($pdo, $user_id) {
    $query = 'SELECT roles.labels FROM assign INNER JOIN roles ON assign.role_id = roles.id WHERE assign.user_id = :user_id';
    $req = $pdo->prepare($query);
    $req->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}

function assignUserRole($pdo, $user_id, $role_id) {
    $query = 'INSERT INTO assign (user_id, role_id) VALUES (:user_id, :role_id)';
    $req = $pdo->prepare($query);
    $req->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $req->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $req->execute();
}

function updateUserRole($pdo, $user_id, $role_id) {
    $query = 'UPDATE assign SET role_id = :role_id WHERE user_id = :user_id';
    $req = $pdo->prepare($query);
    $req->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $req->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $req->execute();
}
