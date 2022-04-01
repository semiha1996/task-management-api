<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Content-Type,'
        . 'Access-Control-Allow-Methods, Authiorization, X-Requested-With');

include_once 'api/models/Tag.php';
include_once 'api/config/Database.php';

//Connect to the DB
$db = new Database();
$database = $db->connectToDB();

$tag = new Tag($database);

//Get the input
$data = json_decode(file_get_contents("php://input"));

    foreach($data as $row){
    if ($tag->update($row)) {
        echo json_encode(array('message' => 'Tag updated successfully'));
    } else {
        echo json_encode(array('message' => 'Could not update tag'));
    }
   }
