<?php
require_once 'db-config.php';

class Database
{
    private static $host = DB_HOST;
    private static $user = DB_USER;
    private static $password = DB_PASSWORD;
    private static $database = DB_DATABASE;

    private static $instance = null;

    private function __construct()
    {
    }
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new mysqli(self::$host, self::$user, self::$password, self::$database);
            return self::$instance;
        }
        return self::$instance;
    }

    private function __destruct(){
        self::$instance->close();
    }
}
