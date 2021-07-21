<?php

final class db
{
    private static $connection;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function connect()
    {
        if (self::$connection === null) {
            $config = require('config/main.php');
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset={$config['db']['charset']}";
            self::$connection = new PDO($dsn, $config['db']['login'], $config['db']['password'], $options);
        }

        return self::$connection;
    }
}