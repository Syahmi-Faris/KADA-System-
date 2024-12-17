<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $db_name = 'pdo_crud';
    private $username = 'root';
    private $password = '';
    private static $pdo = null;

    public function connect()
    {
        if (self::$pdo === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db_name}";
                self::$pdo = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
