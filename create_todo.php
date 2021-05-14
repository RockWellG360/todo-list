<?php
include_once 'config/database.php';
include_once 'controller/todo.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$todo = new Todo($db);

// set page headers
$page_title = "Create Todo";
include_once "views/layouts/layout_header.php";
  
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Todo List</a>
    </div>";

?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set todo property values
    $todo->title = $_POST['title'];
    $todo->description = $_POST['description'];
  
    // create the todo
    if($todo->create()){
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
            <td><input type='text' name='title' /></td>
        </tr>
  
        <tr>
            <td>Description</td>
            <td><textarea name='description'></textarea></td>
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