<?php


namespace App\Manager;


use App\Model\Connection;

class AbstractManager
{
    protected $pdo;

    protected $table;

    protected $className;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->className = __NAMESPACE__ . '\\' . ucfirst($table);
        $this->pdo = (new Connection())->getPdoConnection();
    }
}