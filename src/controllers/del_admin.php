<?php
session_start();
require_once('src/models/administrator.php');

if(isset($_GET['id_admin']) && ($_GET['id_admin']) == 1){
    header('Location: /admin_crud.php');
}

if(isset($_GET['id_admin']) && ($_GET['id_admin']) != 1){
    $id_admin = $_GET['id_admin'];
    $isDeleted = delAdmin($id_admin);

}else{
    $isDeleted = true;
}
if ($isDeleted) {

    header('Location: /admin_crud.php');
    exit;

}
?>