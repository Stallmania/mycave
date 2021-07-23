<?php
session_start();
require_once('src/models/cave.php');
require_once('src/controllers/config.php');

if (isset($_POST['save'])) {

    $name = ScriptingTesting($_POST['name']);
    $year = ScriptingTesting($_POST['year']);
    $grapes = ScriptingTesting($_POST['grapes']);
    $country = ScriptingTesting($_POST['country']);
    $region = ScriptingTesting($_POST['region']);
    $description = ScriptingTesting($_POST['description']);
    $picture =($_FILES['imageBottel']);

    $fieldsRequired = [$name, $year, $country, $region];
    if (in_array('',$fieldsRequired)) {
        return $ErrorEmptyInputField = '<span style="color:red;">Merci de compléter les champs manquants</span>';
    }

    if (validatingNomberOfChar($name) === false){
        return $ErrorNomberOfCharOfName = '<span style="color:red;">Merci de siasir moins de 50 caractères </span>';
    }

    if (validatingNomberOfChar($grapes) === false){
        return $ErrorNomberOfCharOfGrapes = '<span style="color:red;">Merci de siasir moins de 50 caractères </span>';
    }

    if (validatingNomberOfChar($country, 30) === false){
        return $ErrorNomberOfCharOfCountry = '<span style="color:red;">Merci de siasir moins de 30 caractères </span>';
    }
    if (validatingNomberOfChar($region, 30) === false){
        return $ErrorNomberOfCharOfRegion = '<span style="color:red;">Merci de siasir moins de 30 caractères </span>';
    }
    if (validatingNomberOfChar($picture['name'], 100) === false){
        return $ErrorNomberOfCharPicture = '<span style="color:red;">Merci de siasir moins de 100 caractères sur le nom d\'image</span>';
    }

    if (validatingBottelYear($year) === false) {
        return $ErrorYear = '<span style="color:red;">Merci de siasir une année entre 1900 et '. (date('Y')-1) .'</span>';
    }

    if($picture['name'] == ''){
        $picture['name'] = 'generic.jpg';
    }else {
        $picture['name'] = uniqid().'_'. $picture['name'];
    }

    if (validatingImageExtension($picture) === false) {
        return $ErrorExtension = '<span style="color:red;">séléctionner une image de type png, jpg, jpeg, gif</span>';
    }
    if(validatingImageSize($picture) === false ) {
        return $ErrorSize = '<span style="color:red;">La taille du fichier est limité à 1 Mo, merci de remplacer le fichier</span>';
    }
    if (validatingImageUpload($picture) === false){
        return $ErrorUpload = '<span style="color:red;">Une erreur s\'est produite lors du téléchargement du fichier, merci de renouveler votre envoi</span>'; 
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
    
    $res = createBottle($bottleValues);
    
    move_uploaded_file($picture['tmp_name'], './public/img/'.$picture['name']);

    if ($res) {

        header('Location: ./bottles_crud.php');
        exit;
    }
}
