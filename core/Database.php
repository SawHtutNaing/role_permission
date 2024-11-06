<?php

class Database
{
    private $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';

        try {
            $this->pdo = new PDO(
                'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'],
                $config['db_user'],
                $config['db_pass']
            );
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetch($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch(PDO::FETCH_OBJ);
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function fetchOne($query, $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(); // Fetch one result (associative array by default)
    }
    
}