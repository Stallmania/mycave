<?php
session_start();
require_once('src/models/cave.php');

if(isset($_GET['id_bottle'])){
    $id_bottle = $_GET['id_bottle'];
    $seltecPictureToDelete = getBottlePicture($id_bottle);
    $isDeleted = deleteBottles($id_bottle);

}else{
    $isDeleted = true;
}

if ($isDeleted) {
    unlink('./public/img/'.$seltecPictureToDelete['picture']);
    header('Location: /bottles_crud.php');

    exit;
} else {
    "problème";
}
?>