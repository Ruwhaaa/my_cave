<?php
require 'php/models/dataManager.php';

$fields_required = array($_POST['pseudo'], $_POST['mdp'], $_POST['confirm_mdp']);

if (in_array('', $fields_required)) {
    if(empty($_POST['pseudo'])) {
        $msg_error = "merci de spécifié un login";
    }
    if($_POST['mdp'] || $_POST['confirm_mdp']) {
        $msg_error = "merci de spécifié un bon mot de passe";
    }
    if($_POST['mdp'] !== $_POST['confirm_mdp']) {
        $msg_error = "les deux mot de passe ne sont pas identique";
    }
    header("Location: home?msg=$msg_error&error=true");
}
else {
    $login = htmlentities(trim(mb_strtolower($login)), ENT_QUOTES); // faille XSS
    $password = htmlentities(trim($password), ENT_QUOTES);

    $req = $db->prepare("
		SELECT *
		FROM user u
		INNER JOIN role r
		ON u.id_role = r.id
		WHERE u.email = :email
	");
    $req->bindValue(':email', $login, PDO::PARAM_STR);

    $req->execute();

    $result = $req->fetchObject();
    if(!$result) {
        $msg_error = 'Votre login ou mot de passe est inconnu';
    }
    else {

        if(password_verify($password, $result->password)) {
            $msg_success = 'Vous êtes connecté';
        }
        else {
            $msg_error = 'Votre login ou mot de passe est inconnu';
        }
    }
}

$msg = isset($msg_error);

$last_url = $_SERVER['HTTP_REFERER']; // url d'où je viens
if(strpos($last_url, '?') !== FALSE) {
    $req_get = strrchr($last_url, '?');
    $last_url = str_replace($req_get, '', $last_url);
}
if($msg) {
    header("Location: $last_url?msg=$msg_error");
}
else {

    $_SESSION['firstname'] 	= $result->firstname;
    $_SESSION['lastname'] 	= $result->lastname;
    $_SESSION['id'] 		= $result->id;
    $_SESSION['role'] 		= $result->id_role;
    $_SESSION['role_name'] 	= $result->role_name;
    require __DIR__ . '/last_connect.php';
    $_SESSION['last_connect'] 	= $result->last_connect;


    require __DIR__ . '/new_connect.php';
    header("Location: $last_url?msg=$msg_success");
}
?>