<?php
function currentPage(){
    // On détermine sur quelle page on se trouve
    if(isset($_GET['page']) && !empty($_GET['page'])){
        $currentPageOfBottles = (int) strip_tags($_GET['page']);//empeche injection de script
    }else{
        $currentPageOfBottles = 1;
    }
    return $currentPageOfBottles;
}

?>