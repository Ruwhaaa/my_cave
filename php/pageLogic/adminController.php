<?php
require_once('php/database/dataManager.php');
require_once('php/database/validation.php');

mb_internal_encoding( "UTF-8" );

$fields_required = array($_POST['nom'], $_POST['annee'],
    $_POST['cepage'], $_POST['pays'], $_POST['region'], $_POST['description']);
if(in_array('', $fields_required)) {
    $msg_error = "merci de remplir tous les champs";
} elseif ($_POST['annee'] > 2021){
    $msg_error = "nous ne somme pas encore dans le futur";
} else {
    $name = html(mb_strtoupper($_POST['nom']));
    $year = html($_POST['annee']);
    $grapes = html(mb_strtoupper($_POST['cepage']));
    $country = html(mb_strtoupper($_POST['pays']));
    $region = html(mb_strtoupper($_POST['region']));
    $description = html($_POST['description']);

    $picture = $_FILES['picture'];

    $ext = array('png', 'jpg', 'jpeg', 'gif', 'PNG');
    if (empty($picture['name']) && !empty($_POST['picture_db']) ) {
        $picture = $_POST['picture_db'];
        if (isset($_GET['id']) && isset($_GET['id_wine_picture']) && isset($_GET['id_picture'])) {
            $id = html($_GET['id']);
            $wine_id = html($_GET['id_wine_picture']);
            $picture_id = html($_GET['id_picture']);
            $data = array(
                'id' => $id,
                'nom' => $name,
                'annee' => $year,
                'cepage' => $grapes,
                'pays' => $country,
                'region' => $region,
                'description' => $description,
                'picture' => $picture,
                'id_wine_picture' => $wine_id,
                'id_picture' => $picture_id
            );
            $return = update($data);
            if ($return) {
                $msg = "bouteille bien mise a jour";
                $error = 'false';
            } else {
                $msg = "Oups, une erreur s'est produite";
                $error = 'true';
            }
            header("Location: admin?msg=$msg&error=$error");
        } else {
            $msg_error = "oups vous n'avez rien à faire ici";
            header("Location: admin?msg=$msg_error&error=true");
        }
    }
    if ($picture['error'] > 0 && $picture['error'] < 3) {
        $msg_error = "taille du fichier trop grand";
    }
    elseif ($picture['error'] === 3 || $picture['error'] > 4) {
        $msg_error = "problème pendant l'upload";
    } else {
        if ($picture['error'] === 4) {
            $msg_error = "veuillez ajouter une image";
            header("Location: admin?msg=$msg_error&error=true");
        } else {
            if ($picture['size'] > 4194304) {
                $msg_error = "taille du fichier trop grand";
            }
            elseif (!in_array(strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION)), $ext)) {
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
                    if (isset($_GET['id']) && isset($_GET['id_wine_picture']) && isset($_GET['id_picture'])) {
                        $id = html($_GET['id']);
                        $wine_id = html($_GET['id_wine_picture']);
                        $picture_id = html($_GET['id_picture']);
                        $data = array(
                            'id' => $id,
                            'nom' => $name,
                            'annee' => $year,
                            'cepage' => $grapes,
                            'pays' => $country,
                            'region' => $region,
                            'description' => $description,
                            'picture' => $picture_name,
                            'id_wine_picture' => $wine_id,
                            'id_picture' => $picture_id
                        );
                        $return = update($data);
                    } else {
                        $picture = html($picture_name);
                        $data = array(
                            'nom' => $name,
                            'annee' => $year,
                            'cepage' => $grapes,
                            'pays' => $country,
                            'region' => $region,
                            'description' => $description,
                            'picture' => $picture_name
                        );
                        $return = add($data);
                    }
                    if($return) {
                        $msg = "bouteille bien ajoutée / mise a jour";
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

if(isset($msg_error)) {
   header("Location: admin?msg=$msg_error&error=true");
}