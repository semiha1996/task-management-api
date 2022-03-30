<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'api/models/Tag.php';
include_once 'api/config/Database.php';

$db = new Database();
$database = $db->connectToDB();

$tag = new Tag($database);

$tag->id = $id;

$tag->read_single();

$tagArr = array(
    'id'=>$tag->id,
    'name'=> $tag->name,
    'color'=>$tag->color
);

print_r(json_encode($tagArr));