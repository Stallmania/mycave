<?php
$pageTitle = 'Supprimer une bouteille';
require_once('src/controllers/del_bottle.php');

ob_start();
?>

<div class="card p-3">
    <h1 class="text-primary text-uppercase">La bouteiller est supprimée !</h1>
    <a href="bottles_crud.php">Gestion de Base de donnée</a>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>