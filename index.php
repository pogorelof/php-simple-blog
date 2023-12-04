<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'views/blocks/head.php' ?>
    
    <title>Главная страница</title>
</head>
<body>

<?php require_once 'views/blocks/header.php' ?>

<div>
    <?php print_r($_SESSION['user']) ?>
</div>

</body>
</html>