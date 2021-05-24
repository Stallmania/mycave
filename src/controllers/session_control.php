<?php

function est_conncter():bool{
    if (session_status() === PHP_SESSION_NONE){//si la session n'est pas active
      session_start();////permet de commencer ou de Continuer un session si elle existe
    }
    return !empty($_SESSION['role']);
}
  
function forecer_utilisateur_connceter():void{
    if (!est_conncter()) {
        header('Location: /login.php');
        exit();
    }
}
?>