<?php

require 'vendor/autoload.php';

// core.php holds pagination variables
include_once 'config/core.php';
  
// include database and object files
include_once 'config/database.php';
include_once 'controller/todo.php';

include "Db/Config.php";
include "Db/Factory.php";
include "Db/Adapter/AdapterInterface.php";
include "Db/Adapter/Mysql.php";
include "Db/Adapter/Pdo.php";

$config = new \Db\Config();

$db = \Db\Factory::getConnection($config);
// instantiate database and todo object
// $database = new Database();
// $db = $database->getConnection();
$todo = new Todo($db);
  
// query todos
$stmt = $todo->readAll($from_record_num, $records_per_page);

$loader = new \Twig\Loader\FilesystemLoader('views');

$twig = new \Twig\Environment($loader);

// specify the page where paging is used
$page_url = "index.php?";
  
// count total rows - used for pagination
$total_rows=$todo->countAll();

echo $twig->render('base.html.twig', array(
    'datas'=>$stmt, 
    'total_rows'=>count($total_rows),
    'total_datas'=>count($total_rows), 
    'page_url'=>$page_url,
    'page'=>$page,
    'records_per_page'=>$records_per_page,
    'from_record_num'=>$from_record_num
));

?>