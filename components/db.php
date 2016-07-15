<?php

class DB
{
    private static $instance;

    public static function getConnection()
    {
        if (!isset(self::$instance)) {
            $params = include (ROOT . DS . 'config' . DS . 'db_params.php');
            $dsn = "mysql:host={$params['host']}; dbname={$params['dbname']}";
            self::$instance = new PDO($dsn,  $params['user'], $params['password']);
            self::$instance->exec("set names utf8");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$instance;
    }
    private function __construct() {

    }
    private function __clone() {}

}