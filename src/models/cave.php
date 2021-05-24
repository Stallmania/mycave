<?php
//------------------- Connceter à la BD---------------//
function getPdoConnect(){
    require('connect.php');
    return $pdo;
}

//-------- On détermine le nombre de bouteilles par page pour la pagination----//
function nbOfBottles(){
    $pdo = getPdoConnect();
    //--- calcules-------
    // On détermine le nombre total d'articles
    $sql = 'SELECT COUNT(*) AS nb_bottles FROM `wines`;';

    // On prépare la requête
    $query = $pdo->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nb_bottles = (int) $result['nb_bottles'];

    return $nb_bottles;
}

//---- On détermine le nombre de page qui dépond du nombre de bouteilles.----//
function nbOfPages(){
    $nbOfBottlesPerPage = 8;
    // On calcule le nombre de pages total
    $pages = ceil(nbOfBottles() / $nbOfBottlesPerPage);

    return $pages;
}

//---------------récupere tout les bouteilles avec LIMIT X, Y ---//
function getBottles()
{
    try {

        $nbOfBottlesPerPage = 8;
        // Calcul du 1ere bouteille de la page
        $firstBottle = (currentPage() * $nbOfBottlesPerPage) - $nbOfBottlesPerPage;

        //--- requette-------
        $pdo = getPdoConnect();
        $sql = 'SELECT id_bottle, name, year, grapes, country, region, description, picture FROM `wines` ORDER BY create_time DESC LIMIT :firstBottle, :nbOfBottlesPerPage';

        // On prépare la requête
        $query = $pdo->prepare($sql);

        $query->bindValue(':firstBottle', $firstBottle, PDO::PARAM_INT);
        $query->bindValue(':nbOfBottlesPerPage', $nbOfBottlesPerPage, PDO::PARAM_INT);

        // On exécute
        $query->execute();

        // On récupère les valeurs dans un tableau associatif
        $bottles = $query->fetchAll(PDO::FETCH_ASSOC);

        return $bottles;

    } catch (\PDOException $messageErrorConnection) {

        echo $messageErrorConnection->getMessage();
    }
}

//------------------- recupérer l'image uniquement ---------------//
function getBottlePicture($id_bottle){
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('SELECT picture FROM wines WHERE id_bottle = :id');
    $stmt->bindParam(':id', $id_bottle);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getBottleslist()
{
    try {
        $pdo = getPdoConnect();

        return $pdo->query('SELECT id_bottle, name, description FROM wines ORDER BY create_time DESC;');

    } catch (\PDOException $messageErrorConnection) {

        echo $messageErrorConnection->getMessage();
    }
}


//------------------- supprimer une Bouteille---------------//
function deleteBottles($id_bottle)
{
    $pdo = getPdoConnect();

    $maReqPreparee = $pdo->prepare('DELETE FROM wines WHERE id_bottle = :id LIMIT 1');

    $maReqPreparee->bindParam(':id', $id_bottle);

    return $maReqPreparee->execute();
}


//------------------- Modifier une Bouteille---------------//
function getDetailBottles($id_bottle){
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('SELECT id_bottle, name, year, grapes, country, region, description, picture FROM wines WHERE id_bottle = :id');
    $stmt->bindParam(':id', $id_bottle);
    $res = $stmt->execute();
    if($res){
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
        return [];
    }
}

function updateBottles($id_bottle, $updateValues){
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('UPDATE `wines` SET `name`= :name,`year`=:year,`grapes`=:grapes,`country`=:country,`region`=:region,`description`=:description,`picture`=:picture WHERE id_bottle = :id');

 
    $stmt->bindParam(':name',$updateValues['name']);
    $stmt->bindParam(':year',$updateValues['year']);
    $stmt->bindParam(':grapes',$updateValues['grapes']);
    $stmt->bindParam(':country', $updateValues['country']);
    $stmt->bindParam(':region', $updateValues['region']);
    $stmt->bindParam(':description', $updateValues['description']);
    $stmt->bindParam(':picture', $updateValues['picture']);
    $stmt->bindParam(':id', $id_bottle);

    return $stmt->execute();
}

//--------------------Ajouter une bouteille----------------//
function createBottle($bottleValues){

    $pdo = getPdoConnect();

    $maReqPreparee = $pdo->prepare("INSERT INTO `wines`(`name`,`year`,`grapes`,`country`,`region`,`description`,`picture`)
    VALUES (:name, :year, :grapes, :country, :region, :description, :picture)");

    $maReqPreparee->bindParam(':name', $bottleValues['name']);
    $maReqPreparee->bindParam(':year', $bottleValues['year']);
    $maReqPreparee->bindParam(':grapes', $bottleValues['grapes']);
    $maReqPreparee->bindParam(':country', $bottleValues['country']);
    $maReqPreparee->bindParam(':region', $bottleValues['region']);
    $maReqPreparee->bindParam(':description', $bottleValues['description']);
    $maReqPreparee->bindParam(':picture', $bottleValues['picture']);

    return $maReqPreparee->execute();
}