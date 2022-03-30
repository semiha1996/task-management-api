<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Content-Type,'
        . 'Access-Control-Allow-Methods, Authiorization, X-Requested-With');

include_once 'api/models/Tag.php';
include_once 'api/config/Database.php';

$db = new Database();
$database = $db->connectToDB();

$tag = new Tag($database);

$data = json_decode(file_get_contents("php://input"));

foreach ($data as $row) {
    if ($tag->delete($row)) {
        echo json_encode(array('message' => 'Tag deleted successfully'));
    } else {
        echo json_encode(array('message' => 'Could not delete tag'));
    }
}
   

