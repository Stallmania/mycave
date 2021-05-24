<?php
require_once ('src/models/administrator.php');

if(isset($_POST['login'])){

    $user = getAdminFromLogin($_POST['admin'], $_POST['password']);

    if($user == false){
        echo '<div class="alert alert-danger mt-4" role="alert">
        Nom de l\'administrateur ou mot de passe incorrect !
      </div>';
    }else{
        session_start();
        $_SESSION['role'] = $user;
        header('Location: ./bottles_crud.php');
        exit;
    }
}
