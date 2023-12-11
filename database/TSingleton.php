<?php
require_once 'Database.php';
trait TSingleton{
    private static $db = null;
    private function __construct()
    {
    }

    private static function connect()
    {
        if (self::$db === null) {
            self::$db = Database::getInstance();
        }
        return self::$db;
    }
}