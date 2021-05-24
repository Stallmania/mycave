<?php
$pageTitle = 'Ajouter une bouteille';
require_once('src/controllers/add_bottle.php');

ob_start();
?>

<div class="card p-3">
    <h1 class="text-primary text-uppercase">Ajouter une bouteille</h1>
    <form action="add_bottle.php" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" name="name" placeholder="Nom">
            <label for="floatingName">Nom</label>
        </div>
        <div class="form-floating">
            <input type="number" class="form-control" id="floatingSite" name="year" placeholder="année">
            <label for="floatingSite">Année</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" name="grapes" placeholder="grapes">
            <label for="floatingName">grappe</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" name="country" placeholder="pays">
            <label for="floatingSite">pays</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" name="region" placeholder="région">
            <label for="floatingName">région</label>
        </div>
        <div class="form-floating mt-3">
            <textarea class="form-control" placeholder="Description" id="floatingDescription" name="description"
                style="height: 100px"></textarea>
            <label for="floatingDescription">Description</label>
        </div>
        <div class="mt-3">
            <label for="image" class="form-label">Ajouter une image</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>
        <button type="submit" name="save" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>