<!DOCTYPE html>
<html lang="en">
<?php
$url = $_GET['url'] ?? '';

if ($url === '' || $url === 'home') {
        require 'php/head/headHome.php';
    } elseif ($url === 'admin') {
        require 'php/head/headAdmin.php';
    }
?>

<body>
    <?php

    $url = $_GET['url'] ?? '';

    if ($url === '' || $url === 'home') {
        require 'php/templates/home.php';
    } elseif ($url === 'addform') {
        require 'php/form/addform.php';
    } elseif ($url === 'admin') {
        require 'php/templates/admin.php';
    } elseif ($url === 'updateform') {
        require 'php/form/updateform.php';
    } elseif ($url === 'delete') {
        require 'php/crud/delete.php';
    } elseif ($url === 'adminForm') {
        require 'php/form/adminForm.php';
    } else {
        require 'php/templates/404.php';
    }
?>
</body>
</html>