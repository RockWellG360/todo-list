<?php
// get ID of the todo to be edited
$id = isset($_POST['id']) ? $_POST['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'controller/todo.php';
  
include "Db/Config.php";
include "Db/Factory.php";
include "Db/Adapter/AdapterInterface.php";
include "Db/Adapter/Mysql.php";
include "Db/Adapter/Pdo.php";

// get database connection
$config = new \Db\Config();

$db = \Db\Factory::getConnection($config);
  
// prepare objects
$todo = new Todo($db);
  
// set ID property of todo to be edited
$todo->id = $id;
  
// read the details of todo to be edited
$todo->readOne();
  
// if the form was submitted
if($_POST){
  
    // set todo property values
    $todo->title = $_POST['id'];
    $todo->title = $_POST['title'];
    $todo->description = $_POST['description'];

    // update the todo
    if($todo->updateTodo()){
       echo "Todo was updated.";
    }
  
    // if unable to update the todo, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update todo.";
        echo "</div>";
    }
}
?>