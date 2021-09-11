<!DOCTYPE html>
<html lang="fr">
<?php
session_start();

$url = $_GET['url'] ?? '';

if ($url === '' || $url === 'home') {
        require 'php/pageTemplate/head/headHome.php';
    } elseif ($url === 'admin') {
        require 'php/pageTemplate/head/headAdmin.php';
    }
?>

<body>
    <?php

    $url = $_GET['url'] ?? '';

    if ($url === '' || $url === 'home') {
        require 'php/pageTemplate/header.php';
        require 'php/pageTemplate/home.php';
    }elseif ($url === 'admin') {
        require 'php/pageTemplate/header.php';
        require 'php/pageTemplate/admin.php';
    }  elseif ($url === 'delete') {
        require 'php/database/delete.php';
    } elseif ($url === 'adminForm') {
        require 'php/pageLogic/adminController.php';
    } elseif ($url === 'register') {
        require 'php/pageLogic/registerController.php';
    } elseif ($url === 'login') {
        require 'php/pageLogic/loginController.php';
    } elseif ($url === 'kill') {
        require 'php/database/kill.php';
    } else {
        require 'php/pageTemplate/404.php';
    }

?>
</body>
<script src="js/index.js"></script>
</html>