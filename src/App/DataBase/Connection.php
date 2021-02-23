<?php


namespace App\DataBase;

use PDO;

class Connection
{
    public static $instance;

    public static function getInstance()
    {
        try {
            if (!isset(self::$instance)) {
                $dns = "mysql:host=";
                $dns .= $_ENV['MYSQL_DB_HOST'].";";
                $dns .= "port=".$_ENV['MYSQL_DB_PORT'].";";
                $dns ."dbname=".$_ENV['MYSQL_DB_NAME'];
                self::$instance = new PDO($dns, $_ENV['MYSQL_DB_USER'], $_ENV['MYSQL_DB_PASSWORD'], array(
                    PDO::ATTR_PERSISTENT => true
                ));
            }
        } catch (\PDOException $e) {
            print($e->getMessage());
        }
        return self::$instance;
    }

}


