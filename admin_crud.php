<?php
session_start();
ob_start();

require_once('src/models/administrator.php');
$admins = getAdminList();
$JustOneAdmin = false;
?>
<div style="display: flex; justify-content:space-between">
    <a href="add_admin.php" class="btn btn-info m-1">Ajouter un administrateur</a>
    <a href="bottles_crud.php" class="btn btn-light m-1">Retour à l'édition des bouteilles</a>
</div>
<div class="row">
    <?php foreach ($admins as $key=>$admin) : ?>
        <div class="col-md-4 m-4 bg-primary">
            <ul class="list-group">
                <li class="list-group-item"><strong>Nom </strong><?= $admin['firstName'] ?></li>
                <li class="list-group-item"><strong>Prénom </strong><?= $admin['lastName'] ?></li>
                <li class="list-group-item"><strong>Email </strong><?= $admin['email'] ?></li>
                <li class="list-group-item"><strong>Tél </strong><?= $admin['phone'] ?></li>
            </ul>
        </div>
        <div class="col-md-6" >
            <div class="m-3 mt-4 text-center">
                <a href="upd_admin.php?id_admin=<?= $admin['id_admin'] ?>" class="btn btn-info">Editer</a>
            </div>
            <?php  if($admin['id_admin'] != 1): ?>
            <div class="m-3 mt-4 text-center">
                <a href="del_admin.php?id_admin=<?= $admin['id_admin'] ?>" class="btn btn-Warning">Supprimer</a>
            </div>
            <?php endif ?>
        </div>
    <hr style="background: #fff;content: '§';padding: 4;">
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>