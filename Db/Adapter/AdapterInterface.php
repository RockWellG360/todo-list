<?php
namespace Db\Adapter;
/**
 * Abstract interface
 */
interface AdapterInterface
{
    public function getConnection(\Db\Config $config);
    public function getAllTodo(int $from_record_num, int $records_per_page);
    public function getTodo();
    public function countTodo();
    public function insert(array $data);
    public function editTodo(array $data);
    public function remove(array $data);
}
?>