<?php

class Todo{
  
    
    // database connection and table name
    private $conn;
    private $table_name = "todos";
  
    // object properties
    public $id;
    public $title;
    public $description;
    public $timestamp;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // create todo
    function create(){
  
       // insert query
        $query = "INSERT INTO " . $this->table_name . "
        SET title=:title,description=:description,created_at=:created_at";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
  
        // to get time-stamp for 'created_at' field
        $this->timestamp = date('Y-m-d H:i:s');
  
        // bind values 
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created_at", $this->timestamp);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

    function readAll($from_record_num, $records_per_page){
  
        $query = "SELECT
                    id, title, description, created_at
                FROM
                    " . $this->table_name . "
                ORDER BY
                    title ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
      
        $stmt = $this->conn->fetch( $query );

        return $stmt;
    }

    // used for paging todos
    public function countAll(){
    
        $query = "SELECT id FROM " . $this->table_name . "";
    
        $stmt = $this->conn->fetch( $query );
    
        return $stmt;
    }

    function readOne(){
  
        $query = "SELECT title, description
            FROM " . $this->table_name . "
            WHERE id = ?
            LIMIT 0,1";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->title = $row['title'];
        $this->description = $row['description'];
    }

    function update(){
  
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    title = :title,
                    description = :description
                WHERE
                    id = :id";
      
        $stmt = $this->conn->prepare($query);
      
        // posted values
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        // bind parameters
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
      
        // execute the query
        if($stmt->execute()){
            return true;
        }
      
        return false;
          
    }

    // delete the product
    function delete(){
    
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // read products by search term
    public function search($search_term, $from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    title, description
                FROM
                    " . $this->table_name . " 
                WHERE
                    title LIKE ? OR description LIKE ?
                ORDER BY
                    title ASC
                LIMIT
                    ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }
    
    public function countAll_BySearch($search_term){
    
        // select query
        $query = "SELECT
                    COUNT(*) as total_rows
                FROM
                    " . $this->table_name . " 
                WHERE
                    title LIKE ? OR description LIKE ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
    
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
?>