<?php
// check if value was posted
if($_POST){
  
    // include database and object file
    include_once 'config/database.php';
    include_once 'controller/todo.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare todo object
    $todo = new Todo($db);
      
    // set todo id to be deleted
    $todo->id = $_POST['object_id'];
      
    // delete the todo
    if($todo->delete()){
        echo "Object was deleted.";
    }
      
    // if unable to delete the todo
    else{
        echo "Unable to delete object.";
    }
}
?>