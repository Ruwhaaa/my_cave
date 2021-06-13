<?php
require ('php/validation/validation.php');
require ('php/datamanager/datamanager.php');

if(isset($_POST['name'], $_POST['year'], $_POST['grapes'], $_POST['country'], $_POST['region'], $_POST['description'], $_POST['picture'])) {
    if(!empty($_POST['name']) && !empty($_POST['year']) && !empty($_POST['grapes']) && !empty($_POST['country']) && !empty($_POST['region']) && !empty($_POST['description']) && !empty($_POST['picture'])) {
        $name = valid_data($_POST['name']);
        $year = valid_data($_POST['year']);
        $grapes = valid_data($_POST['grapes']);
        $country = valid_data($_POST['country']);
        $region = valid_data($_POST['region']);
        $description = valid_data($_POST['description']);
        $picture = valid_data($_POST['picture']);

        add($name, $year, $grapes, $country, $region, $description, $picture);
        header('location: ./admin&status=success');
    } else {
        header('location: ./admin&status=missing');
    }
} else {
    header('location: ./admin&status=missing');
}