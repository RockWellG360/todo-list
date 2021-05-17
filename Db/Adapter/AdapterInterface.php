<?php
namespace Db\Adapter;
/**
 * Abstract interface
 */
interface AdapterInterface
{
    public function getConnection(\Db\Config $config);
    public function fetch($sql);
}
?>