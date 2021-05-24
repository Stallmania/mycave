<?php
session_start();
require_once('src/models/administrator.php');

$admin = getAdmin($_GET['id_admin']);

if(isset($_POST['modifier'])){
    $adminValues = [
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => $_POST['password'],
    ];

    //traiment d'update
    $res = updAdmin($_GET['id_admin'], $adminValues);

    if($res){
        //header('Location: ./upd_admin.php?id_admin='.$_GET['id_admin']);
        header('Location: ./admin_crud.php');
        exit;
    }
}
