<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'api/models/Task.php';
include_once 'api/models/Tag.php';
include_once 'api/config/Database.php';

//Connect to the DB
$db = new Database();
$database = $db->connectToDB();

$task = new Task($database);
$tag = new Tag($database);

//Call the method from Task class to read a task by id
$task->id = $id;
$resultTask = $task->read_single();

$numTask = $resultTask->rowCount();
//Check if there is data in the db and store it in array
if ($numTask > 0) {
    $taskArr = array();
    $taskArr['tasks'] = array();
    while ($rows = $resultTask->fetch(PDO::FETCH_ASSOC)) {
        extract($rows);

        if (!array_key_exists($Task, $taskArr['tasks'])) {
            $taskArr['tasks'][$Task] = array();
        }

        if (!array_key_exists('tags', $taskArr['tasks'][$Task])) {
            $taskArr['tasks'][$Task]['tags'] = array();
        }
        array_push($taskArr['tasks'][$Task]['tags'], $Tag);

        if (!array_key_exists('colors', $taskArr['tasks'][$Task])) {
            $taskArr['tasks'][$Task]['colors'] = array();
        }
        array_push($taskArr['tasks'][$Task]['colors'], $Color);
    }
}
print_r(json_encode($taskArr));
