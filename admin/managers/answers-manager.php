<?php
require '../../../includes/inc-db-connect.php';

function getAllAnswers($pdo) {
    $query = 'SELECT * FROM answers';
    $req = $pdo->prepare($query);
    $req->execute();
    return $req->fetchAll();
}

function getAnswersById($pdo, $id) {
    $query = 'SELECT * FROM answers WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch();
}

function insertAnswers($pdo, $answer, $question_id, $is_correct) {
    $query = 'INSERT INTO answers (answer, question_id, is_correct) VALUES (:answer, :question_id, :is_correct)';
    $req = $pdo->prepare($query);
    $req->bindParam(':answer', $answer);
    $req->bindParam(':question_id', $question_id);
    $req->bindParam(':is_correct', $is_correct);

    $req->execute();
}

function updateAnswers($pdo, $id, $answer, $question_id, $is_correct) {
    $query = 'UPDATE answers SET answer = :answer, question_id = :question_id, is_correct = :is_correct WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':answer', $answer);
    $req->bindParam(':question_id', $question_id);
    $req->bindParam(':is_correct', $is_correct);
    $req->bindParam(':id', $id, PDO::PARAM_INT);

    $req->execute();
}

function deleteAnswers($pdo, $id) {
    $query = 'DELETE FROM answers WHERE id = :id';
    $req = $pdo->prepare($query);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
}
