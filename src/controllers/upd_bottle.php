<?php
session_start();
require_once('src/models/cave.php');
require_once('src/controllers/config.php');

$bottle = getDetailBottles($_GET['id_bottle']);

if (isset($_POST['modifier'])) {

    $name = $_POST['name'];
    $year = $_POST['year'];
    $grapes = $_POST['grapes'];
    $country = $_POST['country'];
    $region = $_POST['region'];
    $description = $_POST['description'];
    $picture = $_FILES['imageBottel'];

    $fields = [$name, $year, $country, $region];

    if (in_array('',$fields)) {
        return $ErrorEmptyInputField = '<span style="color:red;">Merci de compléter les champs manquants</span>';
    }

    if (validatingBottelYear($year) === false) {
        return $ErrorYear = '<span style="color:red;">Merci de siasir une année entre 1900 et '. (date('Y')-1) .'</span>';
    }

    if($picture['name'] == !''){
        if (validatingImageExtension($picture) === false) {
            return $ErrorExtension = '<span style="color:red;">séléctionner une image de type png, jpg, jpeg, gif</span>';
        }
        if(validatingImageSize($picture) === false ) {
            return $ErrorSize = '<span style="color:red;">La taille du fichier est limité à 1 Mo, merci de remplacer le fichier</span>';
        }
        if (validatingImageUpload($picture) === false){
            return $ErrorUpload = '<span style="color:red;">Une erreur s\'est produite lors du téléchargement du fichier, merci de renouveler votre envoi</span>'; 
        }
    }

    if ($picture['name'] == '') {
        $picture['name'] = $bottle['picture'];
    }else {
        $picture['name'] = uniqid() . $picture['name'];
    }
    $bottleValues = [
        'name' => $_POST['name'],
        'year' => $_POST['year'],
        'grapes' => $_POST['grapes'],
        'country' => $_POST['country'],
        'region' => $_POST['region'],
        'description' => $_POST['description'],
        'picture' => $picture['name']
    ];

    //traiment d'update
    $res = updateBottles($_GET['id_bottle'], $bottleValues);

    if($picture['name'] != ''){
        move_uploaded_file($picture['tmp_name'], './public/img/'.$picture['name']);
        if($bottle['picture'] != 'generic.jpg' and $picture['name'] != $bottle['picture']){
            /**
             * unlink permet de supprimer un fichier
             * Nous supprimer l'ancienne image si ce n'est pas default.jpg
             */
            unlink('./public/img/'.$bottle['picture']);
        }
    }
    if($res){
        
        //header('Location: ./upd_bottle.php?id_bottle='.$_GET['id_bottle']);
        header('Location: ./bottles_crud.php');
        exit;
    }
}
