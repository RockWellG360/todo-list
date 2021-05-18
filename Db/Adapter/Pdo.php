<?php
namespace Db\Adapter;

use PDOException;

/**
 * MySQLi Pdo
 */
class Pdo implements \Db\Adapter\AdapterInterface
{
    public $conn;
    public $table_name = "todos";

     /**
     * @param string $config->host
     * @param string $config->user
     * @param string $config->password
     * @param string $config->dbscheme
     */

    public function getConnection(\Db\Config $config)
    {
        try{
            $this->conn = new \PDO("mysql:host=" . $config->host . ";dbname=" . $config->dbscheme, $config->user, $config->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        
    }

    /**
     * @param string $from_record_num
     */

    public function getAllTodo(int $from_record_num, int $records_per_page)
    {
        $sql = "SELECT
                    id, title, description, created_at
                FROM
                    " . $this->table_name . "
                ORDER BY
                    created_at DESC
                LIMIT
                    $from_record_num, $records_per_page";

        $sth = $this->conn->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function getTodo()
    {
        $query = "SELECT title, description
            FROM " . $this->table_name . "
            WHERE id = ?
            LIMIT 0,1";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        
        $stmt->execute();
        return $stmt->fetch();
    }

    public function countTodo(){
        $query = "SELECT id FROM " . $this->table_name . "";
    
        $sth = $this->conn->prepare($query);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function insert(array $data){
        
        $query = "INSERT INTO " . $this->table_name . "
        SET title=:title,description=:description,created_at=:created_at";

        $stmt = $this->conn->prepare($query);
  
        // posted values
        $data['title']=htmlspecialchars(strip_tags($data['title']));
        $data['description']=htmlspecialchars(strip_tags($data['description']));
  
        // to get time-stamp for 'created_at' field
        $data['timestamp'] = date('Y-m-d H:i:s');
  
        // bind values 
        $stmt->bindParam(":title", $data['title']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":created_at", $data['timestamp']);

        $stmt->execute();
    }

    public function editTodo(array $data){

        $query = "UPDATE " . $this->table_name . "
        SET title=:title,description=:description WHERE id=:id";
      
        $stmt = $this->conn->prepare($query);
      
        // posted values
        $data['title']=htmlspecialchars(strip_tags($data['title']));
        $data['description']=htmlspecialchars(strip_tags($data['description']));
        $data['id']=htmlspecialchars(strip_tags($data['id']));
      
        // bind parameters
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':id', $data['id']);

        $stmt->execute();
    }

    public function remove(array $data){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        // posted values
        $data['title']=htmlspecialchars(strip_tags($data['id']));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);

        $stmt->execute();
    }
}
?>