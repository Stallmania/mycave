<?php 
require_once('src/controllers/details_bottle.php');
ob_start();
?>

<div class="card p-4 m-4">
  <div class="row g-5 mt-0">
    <div class="col-md-6">
      <img src="public/img/<?=$bottle['picture']?>"  alt="wine-picture" style="max-width:200px;">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <Span class="card-title fs-2"><?=$bottle['name']. ' ' ?> </span>
        <span class="card-title fs-2 fw-bold"><?=$bottle['year']?></span>
        <h3 class="card-title fs-3"><?=$bottle['country']?></h3>
        <h4 class="card-title fs-3">Région: <?=$bottle['region']?></h4>
        <h5 class="card-title fs-4">Grappe: <?=$bottle['grapes']?></h5>
        <p class="card-text">description:</br><?=$bottle['description']?></p>
      </div>
    </div>
  </div>
</div>
<br>
<?php
$content = ob_get_clean();
require_once('template/layout.html'); 
?>