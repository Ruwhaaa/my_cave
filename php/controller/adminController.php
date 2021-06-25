<?php
require_once('php/models/dataManager.php');
require_once ('php/models/validation.php');

mb_internal_encoding( "UTF-8" );

$fields_required = array($_POST['name'], $_POST['year'],
    $_POST['grapes'], $_POST['country'], $_POST['region'], $_POST['description']);
if(in_array('', $fields_required)) {
    $msg_error = "merci de remplir tous les champs";
} elseif ($_POST['year'] > 2021){
    $msg_error = "nous ne somme pas encore dans le futur";
} else {
    $name = html(mb_strtoupper($_POST['name']));
    $year = html($_POST['year']);
    $grapes = html(mb_strtoupper($_POST['grapes']));
    $country = html(mb_strtoupper($_POST['country']));
    $region = html(mb_strtoupper($_POST['region']));
    $description = html($_POST['description']);

    $picture = $_FILES['picture'];

    $ext = array('png', 'jpg', 'jpeg', 'gif', 'PNG');
    if (empty($picture['name'])) {
        $picture = $_POST['picture_db'];
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
                'picture' => $picture
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
        if($picture['error'] === 4) {
            $picture_name = 'generic.jpg';
        } else {
            echo "deuxième couche";
            if ($picture['size'] > 4194304) {
                $msg_error = "taille du fichier trop grand";
            }
            elseif (!in_array(strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION)), $ext)) {
                $msg_error = "le fichier n'est pas une image";
            } else {
                echo "troisième couche";
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