<?php
session_start();
require_once('src/models/administrator.php');
require_once('src/controllers/config.php');

$admin = getAdmin($_GET['id_admin']);

if(isset($_POST['modifier'])){
    $firstName = ScriptingTesting($_POST['firstName']);
    $lastName = ScriptingTesting($_POST['lastName']);
    $email = ScriptingTesting($_POST['email']);
    $phone = ScriptingTesting($_POST['phone']);
    $pass = ScriptingTesting($_POST['password']);
    
    $fields = [$firstName, $lastName, $email, $phone, $pass];
    if (in_array('',$fields)) {
        return $ErrorEmptyInputField = '<span style="color:red;">Merci de compléter les champs manquants</span>';
    }

    if(validatingEmail($email) === false) {
        return $ErrorEmail = '<span style="color:red;">Merci de renseigner un email valide!</span>';
    }

    if (validatingPhone($phone) === false) {
        return $ErrorTel = '<span style="color:red;">numéro de téléphone invalide !</span>';
    }else{
        $phone = validatingPhone($phone);
    }
    if (validatingPassWord($pass) !== 1) {
        return $ErrorPass = '<span style="color:red;">Votre mot de passe doit comporter au moins 8 caractères, une majuscule, un caractère spécial et un chiffre</span>';
    }

    $updateValues = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'phone' => $phone,
        'password' => password_hash($pass,PASSWORD_DEFAULT)
    ];


    $res = updAdmin($_GET['id_admin'], $updateValues);

    if($res){

        header('Location: ./admin_crud.php');
        exit;
    }
}
