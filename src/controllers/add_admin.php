<?php
session_start();
require_once('src/models/administrator.php');
require_once('src/controllers/config.php');


if (isset($_POST['save'])) {
    $firstName = ScriptingTesting($_POST['firstName']);
    $lastName = ScriptingTesting($_POST['lastName']);
    $email = ScriptingTesting($_POST['email']);
    $phone = ScriptingTesting($_POST['phone']);
    $pass = ScriptingTesting($_POST['password']);

    $fields = [$firstName, $lastName, $email, $phone, $pass];
    if (in_array('',$fields)) {
        return $ErrorEmptyInputField = '<span style="color:red;">Merci de compléter les champs manquants</span>';
    }
    if (validatingNomberOfChar($firstName,30) === false){
        return $ErrorNomberOfCharOfFirstName = '<span style="color:red;">Merci de siasir moins de 30 caractères </span>';
    }
    if (validatingNomberOfChar($lastName,30) === false){
        return $ErrorNomberOfCharOfLastName = '<span style="color:red;">Merci de siasir moins de 30 caractères </span>';
    }
    
    if((validatingEmail($email) === false) or (validatingNomberOfChar($email,50) === false)) {
        return $ErrorEmail = '<span style="color:red;">Merci de renseigner un email valide (moins de 50 caractères) !</span>';
    }

    if (validatingPhone($phone) === false) {
        return $ErrorTel = '<span style="color:red;">numéro de téléphone invalide !</span>';
    }else{
        $phone = validatingPhone($phone);
    }

    if ((validatingPassWord($pass) !== 1) or (validatingNomberOfChar($pass,50) === false)) {
        return $ErrorPass = '<span style="color:red;">Votre mot de passe doit comporter au moins 8 caractères, une majuscule, un caractère spécial et un chiffre (50 caractères maximum)</span>';
    }
    $adminleValues = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => strtolower($email),
        'phone' => $phone,
        'password' => password_hash($pass,PASSWORD_DEFAULT)
    ];

    $res = addAdmin($adminleValues);

    if ($res) {
        header('Location: ./admin_crud.php');
        exit;
    }
}
