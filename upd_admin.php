<?php
$pageTitle = 'Editer un administarteur';
require_once('src/controllers/upd_admin.php');

ob_start();
?>
<div class="card p-3">
    <h1 class="text-primary text-uppercase">modifier les informations d'un administrateur</h1>
    <form action="upd_admin.php?id_admin=<?=$admin['id_admin'] ?>" method="post" enctype="multipart/form-data">
    <?php if (isset($ErrorEmptyInputField)){echo $ErrorEmptyInputField;} ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$admin['firstName'] ?>" name="firstName" required>
            <label for="floatingName">Nom</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" value="<?=$admin['lastName'] ?>" name="lastName" required>
            <label for="floatingSite">Prénom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$admin['email'] ?>" name="email" required>
            <label for="floatingName">email</label>
        </div>
        <?php if (isset($ErrorEmail)) {echo "$ErrorEmail";} ?>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" value="<?=$admin['phone'] ?>" name="phone" required>
            <label for="floatingSite">Tél.</label>
        </div>
        <?php if (isset($ErrorTel)) {echo "$ErrorTel";} ?>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingName" name="password" required>
            <label for="floatingName">Nouveau mot de passe</label>
        </div>
        <?php if (isset($ErrorPass)) {echo "$ErrorPass";} ?>
        <button type="submit" name="modifier" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>