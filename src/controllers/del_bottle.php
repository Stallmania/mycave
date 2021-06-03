<?php
session_start();
require_once('src/models/cave.php');

if(isset($_GET['id_bottle'])){
    $id_bottle = $_GET['id_bottle'];
    $seltecNamePictureToDelete = getBottlePicture($id_bottle)['picture'];

    $isDeleted = deleteBottles($id_bottle);
    
}else{
    $isDeleted = true;
}

if ($isDeleted and ($seltecNamePictureToDelete != 'generic.jpg') ) {
    unlink('./public/img/'.$seltecNamePictureToDelete);
}
header('Location: /bottles_crud.php');
exit;

?>