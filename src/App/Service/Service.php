<?php


namespace App\Service;


use App\DataBase\Connection;

class Service implements IByField
{
    protected $connection;
    protected $table;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function getByField(array $values)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE ";
        foreach ($values as $key  => $value){
            $sql .= $key."=".$value." AND";
        }
        $sql = preg_replace("( AND$)", ';', $sql);
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}