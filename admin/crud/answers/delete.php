<?php
require '../../managers/answers-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    deleteAnswers($pdo, $id);
}

header('Location: index.php');
