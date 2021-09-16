<?php
require_once 'php/database/dataManager.php';
require_once 'php/database/validation.php';

if (empty($_POST['search'])) {
        $msg_error_true = "merci de spécifié une recherche";
} else {
    $search = html($_POST['search']);
    $msg_error = "votre résultat de recherche";
    if ($_GET['page'] === 'home') {
        header("Location: home?msg=$msg_error&error=false&search=true&result=$search");
    } if ($_GET['page'] === 'admin') {
        header("Location: admin?msg=$msg_error&error=false&search=true&result=$search");
    }
}

if (isset($msg_error_true) ) {
    header("Location: admin?msg=$msg_error&error=true");
}