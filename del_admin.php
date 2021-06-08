<?php
require_once('src/controllers/del_admin.php');
ob_start();
?>

<div class="card p-3">
    <h1 class="text-primary text-uppercase">L'administrateur est supprimée !</h1>
    <a href="admin_crud.php">Gestion ded admins</a>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>