<?php
namespace Db\Adapter;

use PDOException;

/**
 * MySQLi Pdo
 */
class Pdo implements \Db\Adapter\AdapterInterface
{
    public $conn;

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
    public function fetch($sql)
    {
        $sth = $this->conn->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}
?>