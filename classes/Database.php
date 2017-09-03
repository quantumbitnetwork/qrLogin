<?php

namespace Rayac\qrlogin;


use PDO;

class Database
{
    private static $pdo;
    private function __construct()
    {
    }
    public static function getPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO('mysql:host=localhost;dbname=dbTest;charset=utf8', $_ENV['DB_USER'], $_ENV['DB_PASS']);
        }
        return self::$pdo;
    }
}