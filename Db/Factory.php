<?php
namespace Db;
/**
 * Db Factory
 */
class Factory
{
    public static function getConnection(Config $config)
    {
        $className = sprintf("\\Db\\Adapter\\%s", $config->driver);
        if (class_exists($className)) {
            $adapter = new $className();
            $adapter->getConnection($config);
            return $adapter;
        }
    }
}
?>