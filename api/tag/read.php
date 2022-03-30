<?php
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