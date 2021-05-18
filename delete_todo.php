<?php
// check if value was posted
if($_POST){
  
    // include database and object file
    include_once 'controller/todo.php';
  
    include "Db/Config.php";
    include "Db/Factory.php";
    include "Db/Adapter/AdapterInterface.php";
    include "Db/Adapter/Mysql.php";
    include "Db/Adapter/Pdo.php";
    
    // get database connection
    $config = new \Db\Config();

    $db = \Db\Factory::getConnection($config);
  
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