<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}

function getAdminFromLogin($firstName,$password){
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('SELECT firstName, password FROM administrators WHERE firstName = :firstName');
    $stmt->bindParam(':firstName', $firstName);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res && (password_verify($password, $res['password']))) 
    {
        return true;
    }
    else {
        return false;
    }
}

function getAdminList()
{
    try {
        $pdo = getPdoConnect();

        return $pdo->query('SELECT id_admin, firstName, lastName, email, phone FROM administrators ORDER BY create_time DESC;');

    } catch (\PDOException $messageErrorConnection) {

        echo $messageErrorConnection->getMessage();
    }
}

function addAdmin($adminleValues){
    $pdo = getPdoConnect();

    $maReqPreparee = $pdo->prepare("INSERT INTO `administrators`(`firstName`,`lastName`,`email`,`phone`,`password`)
    VALUES (:firstName, :lastName, :email,:phone, :password)");

    $maReqPreparee->bindParam(':firstName', $adminleValues['firstName']);
    $maReqPreparee->bindParam(':lastName', $adminleValues['lastName']);
    $maReqPreparee->bindParam(':email', $adminleValues['email']);
    $maReqPreparee->bindParam(':phone', $adminleValues['phone']);
    $maReqPreparee->bindParam(':password', $adminleValues['password']);

    return $maReqPreparee->execute();
}

function delAdmin($id_admin){
    {
        $pdo = getPdoConnect();
    
        $maReqPreparee = $pdo->prepare('DELETE FROM administrators WHERE id_admin = :id LIMIT 1');
        $maReqPreparee->bindParam(':id', $id_admin);
    
        return $maReqPreparee->execute();
    }
}

//----------------------------------- 2 functions for Update ! -----------------
function getAdmin($id_admin){
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('SELECT id_admin, firstName, lastName, email, phone, password FROM administrators WHERE id_admin = :id');
    $stmt->bindParam(':id', $id_admin);
    $res = $stmt->execute();
    if($res){
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
        return [];
    }
}

function updAdmin($id_admin, $updateValues){
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('UPDATE `administrators` SET `firstName`= :firstName,`lastName`=:lastName,`email`=:email,`phone`=:phone,`password`=:password WHERE id_admin = :id');
 
    $stmt->bindParam(':firstName',$updateValues['firstName']);
    $stmt->bindParam(':lastName',$updateValues['lastName']);
    $stmt->bindParam(':email',$updateValues['email']);
    $stmt->bindParam(':phone', $updateValues['phone']);
    $stmt->bindParam(':password', $updateValues['password']);
    $stmt->bindParam(':id', $id_admin);

    return $stmt->execute();
}

