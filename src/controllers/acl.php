<?php
$currentPage = $_SERVER['PHP_SELF'];

$tabPageAdmin = [
    '/upd_bottle.php',
    '/add_bottle.php',
    '/del_bottle.php',
    '/add_admin.php',   
    '/del_admin.php',   
    '/upd_admin.php',
    '/admin_crud.php',
    '/bottles_crud.php'   
];

$res = array_search($currentPage, $tabPageAdmin);

if($res !== false && !isset($_SESSION['role'])){
    header('Location: /login.php');
    exit;
}