<?php

namespace Bringo;

class DBHelper
{
    protected $pdo;

    public function __construct()
    {
        $config = \Bringo\Config\DBConfig::getDBConfig();
        $host = $config['host'];
        $dbname = $config['dbname'];
        $user = $config['user'];
        $password = $config['password'];
        $options = $config['options'];
        $this->pdo = new \PDO("mysql:host={$host};dbname={$dbname}", $user, $password, $options);
    }

    public function execute($sql, $data = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function fetch($sql, $data = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $boolResult = $stmt->execute($data);
        return $boolResult ? $stmt->fetch() : false;
    }

    public function fetchAll($sql, $data = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $boolResult = $stmt->execute($data);
        return $boolResult ? $stmt->fetchAll() : false;
    }
}
