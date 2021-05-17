<?php
namespace Db\Adapter;
/**
 * MySQLi Adapter
 */
class Mysqli implements \Db\Adapter\AdapterInterface
{
    private $conn;

    public function getConnection(\Db\Config $config)
    {
        $this->conn = new \mysqli($config->host, $config->user, $config->password, $config->dbscheme);
    }
    
    public function fetch($sql)
    {
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}
?>