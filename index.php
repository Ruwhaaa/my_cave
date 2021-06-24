<!DOCTYPE html>
<html lang="fr">
<?php
session_start();

$url = $_GET['url'] ?? '';

if ($url === '' || $url === 'home') {
        require 'php/templates/head/headHome.php';
    } elseif ($url === 'admin') {
        require 'php/templates/head/headAdmin.php';
    }
?>

<body>
    <?php

    $url = $_GET['url'] ?? '';

    if ($url === '' || $url === 'home') {
        require 'php/templates/header.php';
        require 'php/templates/home.php';
    }elseif ($url === 'admin') {
        require 'php/templates/header.php';
        require 'php/templates/admin.php';
    }  elseif ($url === 'delete') {
        require 'php/models/delete.php';
    } elseif ($url === 'adminForm') {
        require 'php/controller/adminForm.php';
    } elseif ($url === 'login') {
        require 'php/controller/loginController.php';
    } else {
        require 'php/templates/404.php';
    }
?>
</body>
</html>