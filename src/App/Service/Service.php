<?php


namespace App\Service;


use App\DataBase\Connection;

class Service
{
    protected \PDO $connection;
    protected static string $table;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

}