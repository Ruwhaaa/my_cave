<?php
require("php/database/dataManager.php");

$id = $_GET['id'];
$response = delete($id);

if ($response) {
    $msg = "bouteille bien supprimée";
    $error = 'false';
} else {
    $msg = "Oups, une erreur s'est produite lors de la supression";
    $error = 'true';
}

header("Location: admin?msg=$msg&error=$error");