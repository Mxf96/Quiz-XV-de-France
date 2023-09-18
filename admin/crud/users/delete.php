<?php
require '../../managers/users-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    deleteUsers($pdo, $id);
}

header('Location: index.php');
