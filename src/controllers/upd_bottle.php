<?php
session_start();
require_once('src/models/cave.php');

$bottle = getDetailBottles($_GET['id_bottle']);

if(isset($_POST['modifier'])){

    if($_FILES['image']['name'] == '' ){
        $picture = $bottle['picture'];
    }else{
        $picture = $_FILES['image']['name'];
    }
    
    $bottleValues = [
        'name' => $_POST['name'],
        'year' => $_POST['year'],
        'grapes' => $_POST['grapes'],
        'country' => $_POST['country'],
        'region' => $_POST['region'],
        'description' => $_POST['description'],
        'picture' => $picture
    ];

    //traiment d'update
    $res = updateBottles($_GET['id_bottle'], $bottleValues);

    if($_FILES['image']['name'] != ''){
        move_uploaded_file($_FILES['image']['tmp_name'], './public/img/'.$picture);
        if($bottle['picture'] != 'generic.jpg'){
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
