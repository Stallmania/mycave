<?php 
    require_once('src/models/filtre.php');
    require_once('src/models/cave.php');
    
    function resultOfData(){
        if(isset($_GET['year'])){
            $bottlesByYear = resGetYears($_GET['year']);
            return $bottlesByYear;
        }
        elseif(isset($_GET['country'])){
            $bottlesByCountry = resGetCountries($_GET['country']);
            return $bottlesByCountry;
        }
        elseif(isset($_GET['region'])){
            $bottlesByRegion = resGetRegions($_GET['region']);
            return $bottlesByRegion;
        }
        else {
            return getBottles();
        }
    }
?>