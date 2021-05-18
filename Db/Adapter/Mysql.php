<?php
namespace Db\Adapter;
/**
 * MySQLi Adapter
 */
class Mysqli implements \Db\Adapter\AdapterInterface
{
    private $conn;
    public $table_name = "todos";
    /**
     * @param string $config->host
     * @param string $config->user
     * @param string $config->password
     * @param string $config->dbscheme
     */

    public function getConnection(\Db\Config $config)
    {
        $this->conn = new \mysqli($config->host, $config->user, $config->password, $config->dbscheme);
    }
    
    /**
     * @param array $data
     */

    public function getAllTodo(int $from_record_num, int $records_per_page){

        $sql = "SELECT
                    id, title, description, created_at
                FROM
                    " . $this->table_name . "
                ORDER BY
                    created_at DESC
                LIMIT
                    $from_record_num, $records_per_page";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTodo(){

        $query = "SELECT title, description
            FROM " . $this->table_name . "
            WHERE id = " . $this->id . "
            LIMIT 0,1";
      
        $stmt = $this->conn->query( $query );

        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function countTodo(){
        $query = "SELECT id FROM " . $this->table_name . "";
    
        $sth = $this->conn->query($query);
        return $sth->fetch_all();
    }

    public function insert(array $data){
        
        $query = "INSERT INTO " . $this->table_name . "
        SET title=?,description=?,created_at=?";

        $result = $this->conn->prepare($query);
  
        // posted values
        $data['title']=htmlspecialchars(strip_tags($data['title']));
        $data['description']=htmlspecialchars(strip_tags($data['description']));
  
        // to get time-stamp for 'created_at' field
        $data['timestamp'] = date('Y-m-d H:i:s');
  
        // bind parameters 
        $result->bind_param("sss", $data['title'],$data['description'],$data['timestamp']);

        $result->execute();
    }

    public function remove(array $data){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        
        // posted values
        $data['title']=htmlspecialchars(strip_tags($data['id']));
        $result = $this->conn->prepare($query);
        $result->bind_param("s", $data['id']);

        $result->execute();
    }

    public function editTodo(array $data){
        
        $query = "UPDATE " . $this->table_name . "
        SET title=?,description=? WHERE id=?";
      
        $result = $this->conn->prepare($query);
      
        // posted values
        $data['title']=htmlspecialchars(strip_tags($data['title']));
        $data['description']=htmlspecialchars(strip_tags($data['description']));
        $data['id']=htmlspecialchars(strip_tags($data['id']));
      
        // bind parameters
        $result->bind_param("sss", $data['title'],$data['description'],$data['id']);
        
        $result->execute();
    }
}
?>