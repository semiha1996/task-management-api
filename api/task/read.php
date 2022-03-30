<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//Include neccessary files
include_once '..\config\Database.php';
include_once '..\models\Task.php';
include_once '..\models\Tag.php';

//Connect to the DB
$db = new Database();
$database = $db->connectToDB();

//Call read method from Task class
$task = new Task($database);
$resultTask = $task->read();

////Call read method from Tag class
$tag = new Tag($database);
$resultTag = $tag->read();

$num = $resultTask->rowCount();
//Check if there is data in the db and store it in array
if($num > 0){
    $taskArr = array();
    $taskArr['data'] = array();
    
    while($rowTask = $resultTask->fetch(PDO::FETCH_ASSOC)){
        extract($rowTask);
        
        $taskElement = array(
            'id'=>$id,
            'name'=>$name,
           $tagElement = array(
               'id'=>$tag->id,
               'name'=>$tag->name,
               'color'=>$tag->color
           )
        );
    
        array_push($taskArr['data'],$taskElement,$tagElement);
    } 
    //Convert to JSON
    echo json_encode($taskArr); 
} else{
    //There are no available tasks
    echo json_encode(
            array('message'=>'No Tasks Found')
    );
}


/*
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'api/models/Tag.php';
include_once 'api/config/Database.php';

$db = new Database();
$database = $db->connectToDB();

//Call read method from Task class
$tag = new Tag($database);
$data= $tag->read();

$num = $data->rowCount();

//Check if there is data in the db and store it in array
if($num > 0){
    $tagArr = array();
    $tagArr['data'] = array();
    
    while($rowTag = $data->fetch(PDO::FETCH_ASSOC)){
        extract($rowTag);
      
        $tagElement = array(
            'id'=>$id,
            'name'=>$name,
            'color'=>$color
        );
    
    array_push($tagArr['data'], $tagElement);
    } 
    //Convert to JSON
     echo json_encode($tagArr); 
} else{
    //There are no available tasks
    echo json_encode(
            array('message'=>'No Tags Found')
    );
}
 * */