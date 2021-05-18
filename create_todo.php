<?php
include_once 'controller/todo.php';

include "Db/Config.php";
include "Db/Factory.php";
include "Db/Adapter/AdapterInterface.php";
include "Db/Adapter/Mysql.php";
include "Db/Adapter/Pdo.php";
  
// get database connection
$config = new \Db\Config();

$db = \Db\Factory::getConnection($config);
  
// pass connection to objects
$todo = new Todo($db);

// set page headers
$page_title = "Create Todo";
$titleErr = '';
$descriptionErr = '';

include_once "views/layouts/layout_header.php";
  
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Todo List</a>
    </div>";

?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){

    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
      } else {
        $todo->title = $_POST['title'];
    
      }
    
      if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
      } else {
        $todo->description = $_POST['description'];
      }
  
    // set todo property values
    
  
    // create the todo
    if(!empty($_POST["title"]) && !empty($_POST["description"])){
        $todo->store();
        echo "<div class='alert alert-success'>todo was created.</div>";
    }
  
    // if unable to create the todo, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create todo.</div>";
    }
}
?>
  
<!-- HTML form for creating a todo -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
  
    <table class='table'>
  
        <tr>
            <td>Title</td>
            <td><input type='text' name='title' /> <span class="error">* <?php echo $titleErr;?></span></td>
        </tr>
  
        <tr>
            <td>Description</td>
            <td><textarea name='description'></textarea> <span class="error">* <?php echo $descriptionErr;?></span></td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
  
    </table>
</form>
<?php

// footer
include_once "views/layouts/layout_footer.php";
?>