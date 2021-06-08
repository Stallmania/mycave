<?php
require_once ('src/models/administrator.php');
require_once ('src/controllers/config.php');

if(isset($_POST['login'])){
    $admin = ScriptingTesting($_POST['admin']);
    $passWord = ScriptingTesting($_POST['password']);
    $user = getAdminFromLogin($admin,$passWord);
    if(empty($_POST['admin']) || empty($_POST['password'])) {
        $ErrorMessage = '<div class="alert alert-danger mt-4" role="alert"> Merci de remplir les champs manquants </div>';
    }
    elseif($user == false){
        $ErrorMessage = '<div class="alert alert-danger mt-4" role="alert">
        Nom de l\'administrateur ou mot de passe incorrect !
      </div>';
    }
    elseif((validatingNomberOfChar($admin,100) === false) ||(validatingNomberOfChar($passWord,100) === false)){
        $ErrorMessage = '<div class="alert alert-danger mt-4" role="alert">
        Nom de l\'administrateur ou mot de passe incorrect !
      </div>';
    
    }else{
        session_start();
        $_SESSION['role'] = $user;
        header('Location: ./bottles_crud.php');
        exit;
    }
}
