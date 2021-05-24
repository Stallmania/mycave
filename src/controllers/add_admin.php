<?php
session_start();
require_once('src/models/administrator.php');

if (isset($_POST['save'])) {
    $adminleValues = [
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => password_hash($_POST['password'],PASSWORD_DEFAULT)
    ];

    $res = addAdmin($adminleValues);

    if ($res) {
        header('Location: ./admin_crud.php');
        exit;
    }
}
