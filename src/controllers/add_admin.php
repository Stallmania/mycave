<?php
session_start();
require_once('src/models/administrator.php');
require_once('src/controllers/config.php');


if (isset($_POST['save'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];

    $fields = [$firstName, $lastName, $email, $phone, $pass];
    if (in_array('',$fields)) {
        return $ErrorEmptyInputField = '<span style="color:red;">Merci de compléter les champs manquants</span>';
    }

    if(validatingEmail($email) === false) {
        return $ErrorEmail = '<span style="color:red;">Merci de renseigner un email valide!</span>';
    }

    if (validatingPhone($phone) === false) {
        return $ErrorTel = '<span style="color:red;">numéro de téléphone invalide !</span>';
    }
    if (validatingPassWord($pass) !== 1) {
        return $ErrorPass = '<span style="color:red;">Votre mot de passe doit comporter au moins 8 caractères, une majuscule, un caractère spécial et un chiffre</span>';
    }

    $adminleValues = [
        'firstName' => ScriptingTesting($firstName),
        'lastName' => ScriptingTesting($lastName),
        'email' => ScriptingTesting($email),
        'phone' => ScriptingTesting($phone),
        'password' => ScriptingTesting(password_hash($pass,PASSWORD_DEFAULT))
    ];

    $res = addAdmin($adminleValues);

    if ($res) {
        header('Location: ./admin_crud.php');
        exit;
    }
}
