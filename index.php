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
  
$page_title = "Todo Lists";
include_once "views/layouts/layout_header.php";
  
// query todos
$stmt = $todo->readAll($from_record_num, $records_per_page);

$loader = new \Twig\Loader\FilesystemLoader('views');

$twig = new \Twig\Environment($loader);

// specify the page where paging is used
$page_url = "index.php?";
  
// count total rows - used for pagination
$total_rows=$todo->countAll();
  
// read_template.twig controls how the todo list will be rendered
echo $twig->render('read_template.twig', array(
    'datas'=>$stmt, 
    'total_rows'=>count($total_rows)
));

// paging.twig controls how the todo list will be rendered
echo $twig->render('paging.twig', array(
    'total_datas'=>count($total_rows), 
    'page_url'=>$page_url,
    'page'=>$page,
    'records_per_page'=>$records_per_page,
    'from_record_num'=>$from_record_num
));

// layout_footer.php holds our javascript and closing html tags
include_once "views/layouts/layout_footer.php";

?>