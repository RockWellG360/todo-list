<?php

class Todo{
  
    
    // database connection and table name
    private $conn;
  
    // object properties
    public $id;
    public $title;
    public $description;
    public $timestamp;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // create todo
    function store(){
  
        $data = array(
            "title" => $this->title,
            "description" => $this->description
        );

        // insert query
        $stmt = $this->conn->insert($data);
        
        if($stmt){
            return true;
        }else{
            return false;
        }
  
    }

    /**
     * @param from_record_num $from_record_num
     * @param records_per_page $records_per_page
     * @return data
     */
    function readAll($from_record_num, $records_per_page){
  
        $stmt = $this->conn->getAllTodo($from_record_num, $records_per_page);

        return $stmt;
    }

    function readOne(){
  
        $row = $this->conn->getTodo();

        $this->title = $row['title'];
        $this->description = $row['description'];
    }

    // used for paging todos
    public function countAll(){
    
        $stmt = $this->conn->countTodo();
    
        return $stmt;
    }

    function updateTodo(){

        $data = array(
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description
        );
        
        // insert query
        $stmt = $this->conn->editTodo($data);

        if($stmt){
            return true;
        }else{
            return false;
        }
          
    }

    // delete the product
    function delete(){
    
        $data = array(
            "id" => $this->id
        );

        $stmt = $this->conn->remove($data);
        
        if($stmt){
            return true;
        }else{
            return false;
        }
    }
}
?>