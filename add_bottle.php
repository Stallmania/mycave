<?php
$pageTitle = 'Ajouter une bouteille';
require_once('src/controllers/add_bottle.php');

ob_start();
?>
<span class="">
    <a href="bottles_crud.php" class="btn btn-light m-1">Retour à l'édition des bouteilles</a>
</span>
<div class="card p-3">
    <h1 class="text-primary text-uppercase">Ajouter une bouteille</h1>
    <form action="add_bottle.php" method="post" enctype="multipart/form-data">
    <?php if (isset($ErrorEmptyInputField)){echo $ErrorEmptyInputField;} ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" name="name" placeholder="Nom" required>
            <label for="floatingName">Nom<span style="color: red;"> *</span></label>
        </div>
        <div class="form-floating">
            <input type="number" class="form-control" id="floatingSite" name="year" placeholder="année" required>
            <label for="floatingSite">Année<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorYear)) {echo "$ErrorYear";} ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" name="grapes" placeholder="grapes">
            <label for="floatingName">grappe</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" name="country" placeholder="pays" required>
            <label for="floatingSite">pays<span style="color: red;"> *</span></label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" name="region" placeholder="région" required>
            <label for="floatingName">région<span style="color: red;"> *</span></label>
        </div>
        <div class="form-floating mt-3">
            <textarea class="form-control" placeholder="Description" id="floatingDescription" name="description"
                style="height: 100px"></textarea>
            <label for="floatingDescription">Description</label>
        </div>
        <div class="mt-3">
            <label for="image" class="form-label">Ajouter une image</label>
            <input class="form-control" type="file" id="image" name="imageBottel">
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
        </div>
        <?php if (isset($ErrorExtension)) {echo "$ErrorExtension";} ?>
        <?php if (isset($ErrorSize)) {echo "$ErrorSize";} ?>
        <?php if (isset($ErrorUpload)) {echo "$ErrorUpload";} ?>
        <button type="submit" name="save" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>