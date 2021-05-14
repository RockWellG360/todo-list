<?php
// get ID of the todo to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';
include_once 'controller/todo.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$todo = new Todo($db);
  
// set ID property of todo to be edited
$todo->id = $id;
  
// read the details of todo to be edited
$todo->readOne();
  
// set page header
$page_title = "Update todo";
include_once "views/layouts/layout_header.php";
  
echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Todo Lists</a>
     </div>";
  
?>
<?php 
// if the form was submitted
if($_POST){
  
    // set todo property values
    $todo->title = $_POST['title'];
    $todo->description = $_POST['description'];
  
    // update the todo
    if($todo->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Todo was updated.";
        echo "</div>";
    }
  
    // if unable to update the todo, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update todo.";
        echo "</div>";
    }
}
?>
  
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Title</td>
            <td><input type='text' name='title' value='<?php echo $todo->title; ?>' /></td>
        </tr>
  
        <tr>
            <td>Description</td>
            <td><textarea name='description'><?php echo $todo->description; ?></textarea></td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
  
    </table>
</form>
  
<?php
// set page footer
include_once "views/layouts/layout_footer.php";
?>