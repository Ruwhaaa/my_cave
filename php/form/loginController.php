<?php
require ('php/datamanager/datamanager.php');
mb_internal_encoding( "UTF-8" );

function html($str): string
{
    return
        htmlspecialchars(trim($str), ENT_QUOTES);
}

function mb_ucFirst($string): string
{
    $string = mb_strtolower($string);
    return mb_strtoupper(mb_substr( $string, 0, 1 )) . mb_substr( $string, 1 );
}

$fields_required = array($_POST['pseudo'], $_POST['mdp']);
if(in_array('', $fields_required)) {
    $msg_error = "merci de remplir tous les champs";
} else {
    $pseudo = html($_POST['pseudo']);
    $mdp = html($_POST['mdp']);

    if (isset($_GET['id'])) {
        $id = html($_GET['id']);
        $data = array(
            'id' => $id,
            'pseudo' => $pseudo,
            'mdp' => $mdp
        );
        $return = update($data);
    } else {
        $data = array(
            'pseudo' => $pseudo,
            'mdp' => $mdp
        );
        $return = add($data);
    }
    if($return) {
        $msg = "utilisateur bien crée";
        $error = 'false';
    }
    else {
        $msg = "Oups, une erreur s'est produite";
        $error = 'true';
    }
    header("Location: admin?msg=$msg&error=$error");
}
