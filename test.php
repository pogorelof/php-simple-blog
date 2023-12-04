<?php
session_start();
require_once 'database/UserModel.php';

$users = UserModel::showAllUsers();

echo '<pre>';
print_r($users);
echo '</pre>';

foreach($users as $user){
    echo $user['login'];
}

$search = 'user';
foreach ($users as $user) {
    if ($user['login'] === $search) {
        $users = [$user];
        break;
    }
}
echo '<pre>';
print_r($users);
echo '</pre>';

foreach($users as $user){
    echo 'work';
    echo $user['login'];
}
