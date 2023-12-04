<?php
session_start();
if($_SESSION['user']['role'] !== 'ADMIN'){
    header('Location: /');
}