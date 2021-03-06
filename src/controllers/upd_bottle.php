<?php
session_start();
require_once('src/models/cave.php');
require_once('src/controllers/config.php');

$bottle = getDetailBottles($_GET['id_bottle']);

if (isset($_POST['modifier'])) {

    $name = ScriptingTesting($_POST['name']);
    $year = ScriptingTesting($_POST['year']);
    $grapes = ScriptingTesting($_POST['grapes']);
    $country = ScriptingTesting($_POST['country']);
    $region = ScriptingTesting($_POST['region']);
    $description = ScriptingTesting($_POST['description']);
    $picture = $_FILES['imageBottel'];

    $fields = [$name, $year, $country, $region];

    if (in_array('',$fields)) {
        return $ErrorEmptyInputField = '<span style="color:red;">Merci de compléter les champs manquants</span>';
    }
    if (validatingNomberOfChar($name, 50) === false){
        return $ErrorNomberOfCharOfName = '<span style="color:red;">Merci de siasir moin de 50 caractères </span>';
    }

    if (validatingNomberOfChar($grapes, 50) === false){
        return $ErrorNomberOfCharOfGrapes = '<span style="color:red;">Merci de siasir moin de 50 caractères </span>';
    }

    if (validatingNomberOfChar($country, 30) === false){
        return $ErrorNomberOfCharOfCountry = '<span style="color:red;">Merci de siasir moin de 30 caractères </span>';
    }
    if (validatingNomberOfChar($region, 30) === false){
        return $ErrorNomberOfCharOfRegion = '<span style="color:red;">Merci de siasir moin de 30 caractères </span>';
    }
    if (validatingNomberOfChar($picture['name'], 100) === false){
        return $ErrorNomberOfCharPicture = '<span style="color:red;">Merci de siasir moin de 100 caractères sur le nom d\'image</span>';
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
        'name' => $name,
        'year' => $year,
        'grapes' => $grapes,
        'country' => $country,
        'region' => $region,
        'description' => $description,
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
