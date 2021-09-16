<?php
require_once 'php/database/dataManager.php';
require_once 'php/database/validation.php';

$fields_required = array($_POST['pseudo'], $_POST['mdp']);

if (in_array('', $fields_required)) {
    if (empty($_POST['pseudo'])) {
        $msg_error = "merci de spécifié un login";
    }
    if (empty($_POST['mdp'])) {
        $msg_error = "merci de spécifié un bon mot de passe";
    }
} else {
    $pseudo = html($_POST['pseudo']);
    $data = array(
        'pseudo' => $pseudo
    );
    $user = login($data);
    if ($pseudo === $user['pseudo'] && password_verify(($_POST['mdp']), $user['mdp'])) {
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $role = role($_SESSION['pseudo']);
        $_SESSION['role'] = $role[0]['role'];
        header("location: home?msg=Bienvenue $pseudo&error=false");
    } else {
        header("location: home?msg=Il semble que vos identifiants soit incorrects :( &error=true");
    }
}

if(isset($msg_error)) {
    header("Location: home?msg=$msg_error&error=true");
}