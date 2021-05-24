<?php
$pageTitle = 'Editer un administarteur';
require_once('src/controllers/upd_admin.php');

ob_start();
?>
<div class="card p-3">
    <h1 class="text-primary text-uppercase">modifier les informations d'un administrateur</h1>
    <form action="upd_admin.php?id_admin=<?=$admin['id_admin'] ?>" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$admin['firstName'] ?>" name="firstName" placeholder="Nom" required>
            <label for="floatingName">Nom</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" value="<?=$admin['lastName'] ?>" name="lastName" placeholder="Prénom">
            <label for="floatingSite">Prénom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$admin['email'] ?>" name="email" placeholder="email">
            <label for="floatingName">email</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" value="<?=$admin['phone'] ?>" name="phone" placeholder="Tél">
            <label for="floatingSite">Tél.</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$admin['password'] ?>" name="password" placeholder="Mot de passe" required>
            <label for="floatingName">Mot de passe</label>
        </div>
        <button type="submit" name="modifier" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>