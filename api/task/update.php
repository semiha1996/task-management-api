<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Content-Type,'
        . 'Access-Control-Allow-Methods, Authiorization, X-Requested-With');

include_once 'api/models/Task.php';
include_once 'api/config/Database.php';

$db = new Database();
$database = $db->connectToDB();

$task = new Task($database);

$data = json_decode(file_get_contents("php://input"));

    foreach($data as $row){
    if ($tag->update($row)) {
        echo json_encode(array('message' => 'Task(s) updated successfully'));
    } else {
        echo json_encode(array('message' => 'Could not update task(s)'));
    }
   }
