<?php
$pageTitle = 'Ajouter un Administrateur';
require_once('src/controllers/add_admin.php');

ob_start();
?>
<span class="">
    <a href="admin_crud.php" class="btn btn-light m-1">Retour à l'édition des administrateurs</a>
</span>
<div class="card m-4">
    <h1 class="text-primary text-uppercase p-4">Ajouter un administrateur</h1>
    <form action="add_admin.php" method="post" enctype="multipart/form-data" class="needs-validation p-2">
    <?php if (isset($ErrorEmptyInputField)){echo $ErrorEmptyInputField;} ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingNameA" name="firstName" required>
            <label for="floatingNameA">Nom<span style="color: red;"> *</span></label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSiteB" name="lastName" required>
            <label for="floatingSiteB">Prénom<span style="color: red;"> *</span></label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingNameC" name="email" required>
            <label for="floatingNameC">Email<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorEmail)) {echo "$ErrorEmail";} ?>
        <div class="form-floating">
            <input type="tel" class="form-control" id="floatingSiteD" name="phone" required>
            <label for="floatingSiteD">Tél.<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorTel)) {echo "$ErrorTel";} ?>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingNameE" name="password" required>
            <label for="floatingNameE">Mot de passe<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorPass)) {echo "$ErrorPass";} ?>
        <button type="submit" name="save" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>