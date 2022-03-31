<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//Include neccessary files
include_once 'api\config\Database.php';
include_once 'api\models\Task.php';
include_once 'api\models\Tag.php';

//Connect to the DB
$db = new Database();
$database = $db->connectToDB();

//Call read method from Task class
$task = new Task($database);
$resultTask = $task->read();

$numTask = $resultTask->rowCount();

//Check if there is data in the db and store it in array
if ($numTask > 0) {
    $taskArr = array();
    $taskArr['tasks'] = array();

    while ($rowTask = $resultTask->fetch(PDO::FETCH_ASSOC)) {
        extract($rowTask);

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
    //Convert to JSON
    echo json_encode($taskArr);
} else {
    //There are no available tasks
    echo json_encode(
            array('message' => 'No Tasks Found')
    );
}