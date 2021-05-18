<?php
namespace Db;
/**
 * Usage
 */
class Config
{
    public function __construct($data) {
        $this->driver = $data;
    }

    public $host = 'localhost';
    public $user = 'root';
    public $password = '';
    public $dbscheme = 'todo_db';
}
?>