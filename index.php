<?php

// Use this namespace
use Steampixel\Route;

// Include router class
include 'api/config/Router.php';

// Define a global basepath
define('BASEPATH','/task-management-api/');

// Add base route (startpage)
Route::add('/', function() {
  echo 'Welcome :-)';
});

// Another base route example
Route::add('/index.php', function() {
  echo 'Welcome :-)';
});


//ROUTES FOR TASKS
// GET all tasks by id
Route::add('/tasks', function() {
    require_once 'api/task/read.php';
}, 'get');

// GET task by id
Route::add('/tasks/([0-9]*)', function($id) {
  require_once 'api/task/read_single.php';
}, 'get');

// POST create task(s)
Route::add('/tasks', function() {
    require_once 'api/task/create.php';
}, 'post');

//PUT update task(s)
Route::add('/tasks', function() {
    require_once 'api/task/update.php';
}, 'put');

//DELETE  task(s)
Route::add('/tasks', function() {
    require_once 'api/task/delete.php';
}, 'delete');



//ROUTES FOR TAGS
// GET tags
Route::add('/tags', function() {
    require_once 'api/tag/read.php';
}, 'get');

// GET tag by id
Route::add('/tags/([0-9]*)', function($id) {
  require_once 'api/tag/read_single.php';
}, 'get');

// POST create tag(s)
Route::add('/tags', function() {
    require_once 'api/tag/create.php';
}, 'post');

//PUT update tag(s)
Route::add('/tags', function() {
    require_once 'api/tag/update.php';
}, 'put');

//DELETE  tag(s)
Route::add('/tags', function() {
    require_once 'api/tag/delete.php';
}, 'delete');


// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)', function($id) {
  echo $var1.' is a great number!';
});


// Add a 404 not found route
Route::pathNotFound(function($path) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 404 Not Found');
  echo 'Error 404 :-(<br>';
  echo 'The requested path "'.$path.'" was not found!';
});

// Add a 405 method not allowed route
Route::methodNotAllowed(function($path, $method) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 405 Method Not Allowed');
  echo 'Error 405 :-(<br>';
  echo 'The requested path "'.$path.'" exists. But the request method "'.$method.'" is not allowed on this path!';
});

// Run the Router with the given Basepath
Route::run(BASEPATH);

// Enable case sensitive mode, trailing slashes and multi match mode by setting the params to true
// Route::run(BASEPATH, true, true, true);