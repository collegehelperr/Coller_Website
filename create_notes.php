<?php

/** @var Connection $connection */
$connection = require_once 'pdo.php';

// Validate note object;

$id = $_POST['id_note'] ?? '';
if ($id){
    $connection->updateNote($id_note, $_POST);
} else {
    $connection->addNote($_POST);
}

header('Location: note.php');
