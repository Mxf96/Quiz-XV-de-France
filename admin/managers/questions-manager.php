<?php
require '../../../includes/inc-db-connect.php';

function getAllQuestions($pdo) {
    $query = 'SELECT * FROM questions';
    $req = $pdo->prepare($query);
    $req->execute();
    return $req->fetchAll();
}

function getQuestionsById($pdo, $id) {
    $query = 'SELECT * FROM questions WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}

function insertQuestions($pdo, $title, $image_path) {
    $query = 'INSERT INTO questions (title, image_path) VALUES (:title, :image_path)';
    $req = $pdo->prepare($query);
    $req->bindParam(':title', $title);
    $req->bindParam(':image_path', $image_path);

    $req->execute();
}

function updateQuestions($pdo, $id, $title, $image_path) {
    $query = 'UPDATE questions SET title = :title, image_path = :image_path WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':title', $title);
    $req->bindParam(':image_path', $image_path);
    $req->bindParam(':id', $id, PDO::PARAM_INT);

    $req->execute();
}

function deleteQuestions($pdo, $id) {
    $query = 'DELETE FROM questions WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
}
