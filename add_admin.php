<?php
$pageTitle = 'Ajouter une bouteille';
require_once('src/controllers/add_admin.php');

ob_start();
?>

<div class="card m-4">
    <h1 class="text-primary text-uppercase p-4">Ajouter un administrateur</h1>
    <form action="add_admin.php" method="post" enctype="multipart/form-data" class="needs-validation p-2">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingNameA" name="firstName" placeholder="Nom" required>
            <label for="floatingNameA">Nom</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSiteB" name="lastName" placeholder="Prénom">
            <label for="floatingSiteB">Prénom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingNameC" name="email" placeholder="Email">
            <label for="floatingNameC">Email</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSiteD" name="phone" placeholder="Tel">
            <label for="floatingSiteD">Tél.</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingNameE" name="password" placeholder="PassWord" required>
            <label for="floatingNameE">Mot de passe</label>
        </div>
        <button type="submit" name="save" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>