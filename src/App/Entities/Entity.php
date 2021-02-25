<?php


namespace App\Entities;


use App\DataBase\Connection;
use PDO;

class Entity implements IBuild
{
    protected static string $table = '';

    public static function getByField(array $values, string $table)
    {
        $connection = Connection::getInstance();

        $sql = "SELECT * FROM {$table} WHERE ";
        foreach ($values as $key  => $value){
            $sql .= $key."='{$value}' AND ";
        }
        $sql = rtrim($sql, " AND ");
        $query = $connection->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}