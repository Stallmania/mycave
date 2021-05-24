<?php

function getYears()
{
    try {
        $pdo = getPdoConnect();
        $sql = 'SELECT year FROM `wines` GROUP BY year ORDER BY year';

        $query = $pdo->prepare($sql);

        $years = $query->execute();

        if($years){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return [];
        }

    } catch (\PDOException $messageErrorConnection) {

        echo $messageErrorConnection->getMessage();
    }
}
function getCountries()
{
    try {
        $pdo = getPdoConnect();
        $sql = 'SELECT country FROM `wines` GROUP BY country ORDER BY country';

        $query = $pdo->prepare($sql);

        $years = $query->execute();

        if($years){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return [];
        }

    } catch (\PDOException $messageErrorConnection) {

        echo $messageErrorConnection->getMessage();
    }
}
function getRegions()
{
    try {
        $pdo = getPdoConnect();
        $sql = 'SELECT region FROM `wines` GROUP BY region ORDER BY region';

        $query = $pdo->prepare($sql);

        $years = $query->execute();

        if($years){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return [];
        }

    } catch (\PDOException $messageErrorConnection) {

        echo $messageErrorConnection->getMessage();
    }
}

//---------------resultats des recherche par filtre ----------------------------//

function resGetYears($year){
    $pdo = getPdoConnect();
    $stmt = $pdo->prepare('SELECT id_bottle, name, year, grapes, country, region, description, picture FROM wines WHERE year = :year');
    $stmt->bindParam(':year', $year);

    $res = $stmt->execute();
    if($res){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return [];
    }
}
function resGetCountries($country){
    $pdo = getPdoConnect();
    $stmt = $pdo->prepare('SELECT id_bottle, name, year, grapes, country, region, description, picture FROM wines WHERE country = :country');
    $stmt->bindParam(':country', $country);
    $res = $stmt->execute();
    if($res){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return [];
    }
}
function resGetRegions($region){
    $pdo = getPdoConnect();
    $stmt = $pdo->prepare('SELECT id_bottle, name, year, grapes, country, region, description, picture FROM wines WHERE region = :region');
    $stmt->bindParam(':region', $region);
    $res = $stmt->execute();
    if($res){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return [];
    }    
}
