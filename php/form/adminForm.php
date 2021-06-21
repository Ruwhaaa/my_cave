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

$fields_required = array($_POST['name'], $_POST['year'],
    $_POST['grapes'], $_POST['country'], $_POST['region'], $_POST['description']);
if(in_array('', $fields_required)) {
    $msg_error = "merci de remplir tous les champs";
} else {
    $name = html(mb_strtoupper($_POST['name']));
    $year = html($_POST['year']);
    $grapes = html(mb_strtoupper($_POST['grapes']));
    $country = html(mb_strtoupper($_POST['country']));
    $region = html(mb_strtoupper($_POST['region']));
    $description = html($_POST['description']);

    $picture = $_FILES['picture'];
    $ext = array('png', 'jpg', 'jpeg', 'gif', 'PNG');

    if ($picture['error'] > 0 && $picture['error'] < 3) {
        $msg_error = "taille du fichier trop grand";
    }
    elseif ($picture['error'] === 3 || $picture['error'] > 4) {
        $msg_error = "problème pendant l'upload";
    } else {
        if ($picture['error'] === 4) {
            $picture_name = 'generic.jpg';
            $set_request = TRUE;
        } else {
            if ($picture['size'] > 4194304) {
                $msg_error = "taille du fichier trop grand";
            } elseif (!in_array(strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION)), $ext)) {
                $msg_error = "le fichier n'est pas une image";
            } else {
                $picture_name = uniqid() . '_' . $picture['name'];
                $img_folder = dirname(dirname(__DIR__)) . '/src/img/';
                @mkdir($img_folder, 0777);
                $dir = $img_folder . $picture_name;

                $move_file = @move_uploaded_file($picture['tmp_name'], $dir);

                if (!$move_file) {
                    $msg_error = "problème pendant l'upload";
                } else {
                    if (isset($_GET['id'])) {
                        $id = html($_GET['id']);
                        $data = array(
                            'id' => $id,
                            'name' => $name,
                            'year' => $year,
                            'grapes' => $grapes,
                            'country' => $country,
                            'region' => $region,
                            'description' => $description,
                            'picture' => $picture_name
                        );
                       $return = update($data);
                    } else {
                        $data = array(
                            'name' => $name,
                            'year' => $year,
                            'grapes' => $grapes,
                            'country' => $country,
                            'region' => $region,
                            'description' => $description,
                            'picture' => $picture_name
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
            }
        }
    }
}
