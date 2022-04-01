<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Content-Type,'
        . 'Access-Control-Allow-Methods, Authiorization, X-Requested-With');

include_once 'api/models/Task.php';
include_once 'api/models/Tag.php';
include_once 'api/config/Database.php';

//Connect to the DB
$db = new Database();
$database = $db->connectToDB();

$task = new Task($database);
$tag = new Tag($database);

//Decode the input
$data = json_decode(file_get_contents("php://input"));

foreach ($data->tasks as $row) {
    if ($task->update($row)) {
        echo json_encode(array('message' => 'Task updated successfully'));
    } else {
        echo json_encode(array('message' => 'Could not update task'));
    }
}
