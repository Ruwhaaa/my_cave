<?php
require 'php/models/dataManager.php';
require_once ('php/models/validation.php');

$fields_required = array($_POST['pseudo'], $_POST['mdp'], $_POST['confirm_mdp']);

if (in_array('', $fields_required)) {
    if(empty($_POST['pseudo'])) {
        $msg_error = "merci de spécifié un login";
    }
    if(empty($_POST['mdp']) || empty($_POST['confirm_mdp'])) {
        $msg_error = "merci de spécifié un bon mot de passe";
    }
} else {
    $pseudo = html($_POST['pseudo']);
    $data = array(
        'pseudo' => $pseudo
    );
       $user = login($data);
    if ($user === FALSE) {
        if($_POST['mdp'] === $_POST['confirm_mdp']) {
            $mdp = password_hash(html($_POST['mdp']), PASSWORD_DEFAULT);
            $data = array(
                'pseudo' => $pseudo,
                'mdp' => $mdp
            );
            signUp($data);
            $msg = "vous avez bien créez votre compte";
            header("location: home?msg=$msg&error=false");
        } else {
            $msg_error = "les deux mot de passe ne sont pas identique";
        }
    } else {
        $msg_error = "l'utilisateur existe déjà";
    }

}

if(isset($msg_error)) {
    header("Location: home?msg=$msg_error&error=true");
}