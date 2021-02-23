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

    public function getByField(string $field, $value)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE ".field."= :field";
        $query = $this->connection->prepare($sql);
        $query->bindParam('field', $value);
        $query->execute();
        return $query->fetch();
    }
}