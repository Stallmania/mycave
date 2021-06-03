<?php
session_start();
require_once('src/models/cave.php');
require_once('src/controllers/config.php');

if (isset($_POST['save'])) {

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

    if($picture['name'] == ''){
        $picture['name'] = 'generic.jpg';
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
        'name' => ScriptingTesting($name),
        'year' => ScriptingTesting($year),
        'grapes' => ScriptingTesting($grapes),
        'country' => ScriptingTesting($country),
        'region' => ScriptingTesting($region),
        'description' => ScriptingTesting($description),
        'picture' => $picture['name']
    ];
    
    $res = createBottle($bottleValues);
    
    move_uploaded_file($picture['tmp_name'], './public/img/'.$picture['name']);

    if ($res) {

        header('Location: ./bottles_crud.php');
        exit;
    }
}
