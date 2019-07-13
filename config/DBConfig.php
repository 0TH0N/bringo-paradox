<?php

namespace Bringo\Config;

class DBConfig
{
    public static function getDBConfig()
    {
        $host = 'localhost';
        $dbname = 'test';
        $user = 'test';
        $password = 'test';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return [
            'host' => $host,
            'dbname' => $dbname,
            'user' => $user,
            'password' => $password,
            'options' => $options,
        ];
    }
}
