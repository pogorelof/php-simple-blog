<?php
require_once 'TSingleton.php';

class UserModel
{
    use TSingleton;

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
    public static function showAllUsersIdKey(){
        $stmt = self::connect()->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        foreach ($result as $row) {
            $users[] = $row;
        }
        $ids = array_column($users, 'id');
        $users = array_combine($ids, $users);
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
        if(!$stmt->execute()){
            die("Ошибка выполнения запроса {$stmt->error}");
        }
    }
    
    public static function editPassword($id, $new_password){
        $stmt = self::connect()->prepare('UPDATE user SET password = ? WHERE id = ?');
        $stmt->bind_param('si', $new_password, $id);
        $stmt->execute();
    }
}
