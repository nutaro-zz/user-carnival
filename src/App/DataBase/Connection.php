<?php


namespace App\DataBase;

use PDO;

class Connection
{
    public static $instance;

    public static function getInstance(): ?PDO
    {
        if (isset(self::$instance))
            return self::$instance;
        $host = getenv("MYSQL_DB_HOST");
        $port = getenv("MYSQL_DB_PORT");
        $database = getenv("MYSQL_DB_NAME");
        $dsn = "mysql:host={$host};port={$port};dbname={$database}";
        self::$instance = new PDO($dsn, getenv('MYSQL_DB_USER'), getenv('MYSQL_DB_PASSWORD'),
            array(
                PDO::ATTR_PERSISTENT => true
            )
        );
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$instance;
    }

}


