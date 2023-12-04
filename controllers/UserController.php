<?php
require '../database/UserModel.php';
session_start();

//TODO: validation
class UserController
{
    public static function register()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password_repeat = $_POST['password_repeat'];

        if ($password !== $password_repeat) {
            //do smth
            die('Пароли отличаются');
        }

        $password = md5($password); //bad practice to hash

        UserModel::addUser($login, $password);
        header('Location: /');
    }

    public static function login()
    {
        $login = $_POST['login'];
        $password = md5($_POST['password']);
        $user = UserModel::findUserByLogin($login);
        if (!empty($user)) {
            if ($user['password'] === $password) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'login' => $user['login'],
                    'role' => $user['role']
                ];
                header('Location: /');
            } else {
                die('Не совпадают');
            }
        } else {
            die('Пользователя не существует');
        }
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }

    public static function delete($id)
    {
        UserModel::deleteUser($id);
    }

    public static function deleteSeveral()
    {
        foreach ($_POST as $id => $v) {
            self::delete($id);
        }
    }

    public static function passwordEdit($id, $new_password){
        UserModel::editPassword($id, $new_password);
    }
}

$action = $_GET['action'];

switch ($action) {
    case 'register':
        UserController::register();
        break;
    case 'login':
        UserController::login();
        break;
    case 'logout':
        UserController::logout();
        header('Location: /');
        break;
    case 'delete':
        $id = $_GET['id'];
        UserController::delete($id);
        header("Location:{$_SERVER['HTTP_REFERER']}");
        break;
    case 'delete-several':
        UserController::deleteSeveral();
        header("Location:{$_SERVER['HTTP_REFERER']}");
        break;
    case 'password-edit':
        $new_password = md5($_POST['newpass']);
        $id = $_GET['id'];
        UserController::passwordEdit($id, $new_password);
        header("Location:{$_SERVER['HTTP_REFERER']}");
        break;
}
