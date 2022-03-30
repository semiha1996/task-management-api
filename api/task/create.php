<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Content-Type,'
        . 'Access-Control-Allow-Methods, Authiorization, X-Requested-With');

include_once 'api/models/Task.php';
include_once 'api/config/Database.php';

$db = new Database();
$database = $db->connectToDB();

$task = new Task($database);

$data = json_decode(file_get_contents("php://input"));

$task->name = $data->name;
$task->color = $data->color;

if($task->create()){
    echo json_encode(array('message'=>'Task(s) created successfully'));
}else{
    echo json_encode(array('message'=>'Could not create task(s)'));
}


