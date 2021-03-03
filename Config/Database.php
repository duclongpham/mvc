<?php

namespace Mvc\Config;

use PDO;
use Doctrine\DBAL\DriverManager;

class Database
{
    private static $bdd = null;
    private static $config;

    private function __construct() {}

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$config = array(
                'dbname' => 'mvc',
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            );
            self::$bdd = DriverManager::getConnection(self::$config);
        }
        
        return self::$bdd;
    }

    public static function queryBuilder() { 
        return self::getBdd()->createQueryBuilder();
    }
}
