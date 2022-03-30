<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../models/Task.php';
include_once '../models/Tag.php';
include_once '../config/Database.php';

$db = new Database();
$database = $db->connectToDB();

$task = new Task($database);
$tag = new Tag($database);

//Get the id
if($task->id = isset($_GET['id'])){
    $task->id = $_GET['id'];
}else{
    die();
}

$task->read_single();

$taskArr = array(
    'id'=>$task->id,
    'name'=> $task->name,
    'id'=>$tag->id,
    'name'=>$tag->name,
    'color'=>$tag->color
);

print_r(json_encode($taskArr));

/*
 * <?php
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
 */