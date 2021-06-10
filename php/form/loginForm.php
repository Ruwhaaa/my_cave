<?php
require ('php/validation/validation.php');
require ('php/datamanager/datamanager.php');

if(isset($_POST['title'], $_POST['description'], $_POST['annee'], $_POST['auteur'], $_POST['prix'], $_POST['image'])) {
    if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['annee']) && !empty($_POST['auteur']) && !empty($_POST['prix']) && !empty($_POST['image'])) {
        $title = valid_data($_POST['title']);
        $description = valid_data($_POST['description']);
        $annee = valid_data($_POST['annee']);
        $auteur = valid_data($_POST['auteur']);
        $prix = valid_data($_POST['prix']);
        $image = valid_data($_POST['image']);

        add($title, $description, $annee, $auteur, $prix, $image);
        header('location: ./home&status=success');
    } else {
        header('location: ./home&status=missing');
    }
} else {
    header('location: ./home&status=missing');
}