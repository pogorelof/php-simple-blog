<?php
require_once 'Database.php';

class UserModel
{
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

    public static function addUser($login, $password, $role = 'CLIENT')
    {
        $stmt = self::connect()->prepare("INSERT INTO user(login, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $login, $password, $role);
        $stmt->execute();
    }

    public static function showAllUsers()
    {
        $stmt = self::connect()->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        foreach ($result as $row) {
            $users[] = $row;
        }
        return $users;
    }

    public static function findUserById($id)
    {
        $stmt = self::connect()->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function findUserByLogin($login)
    {
        $stmt = self::connect()->prepare('SELECT * FROM user WHERE login = ?');
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public static function deleteUser($id)
    {
        $stmt = self::connect()->prepare('DELETE FROM user WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
    
    public static function editPassword($id, $new_password){
        $stmt = self::connect()->prepare('UPDATE user SET password = ? WHERE id = ?');
        $stmt->bind_param('si', $new_password, $id);
        $stmt->execute();
    }
}
