<?php

require_once('src/controllers/upd_bottle.php');

ob_start();
?>
<span class="">
    <a href="bottles_crud.php" class="btn btn-light m-1">Retour à l'édition des bouteilles</a>
</span>
<div class="card p-3">
    <h1 class="text-primary text-uppercase">modifier les information sur une bouteille</h1>
    <form action="upd_bottle.php?id_bottle=<?=$bottle['id_bottle'] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <img src="public/img/<?=$bottle['picture'] ?>" alt="picture" style="max-width:200px;">
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$bottle['name'] ?>" name="name" placeholder="Nom" required>
            <label for="floatingName">Nom<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorNomberOfCharOfName)) {echo "$ErrorNomberOfCharOfName";} ?>
        <div class="form-floating">
            <input type="number" class="form-control" id="floatingSite" value="<?=$bottle['year'] ?>" name="year" placeholder="année" required>
            <label for="floatingSite">Année<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorYear)) {echo "$ErrorYear";} ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$bottle['grapes'] ?>" name="grapes" placeholder="grapes">
            <label for="floatingName">Cépage</label>
        </div>
        <?php if (isset($ErrorNomberOfCharOfGrapes)) {echo "$ErrorNomberOfCharOfGrapes";} ?>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" value="<?=$bottle['country'] ?>" name="country" placeholder="pays" required>
            <label for="floatingSite">pays<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorNomberOfCharOfCountry )) {echo "$ErrorNomberOfCharOfCountry";} ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$bottle['region'] ?>" name="region" placeholder="région" required>
            <label for="floatingName">région<span style="color: red;"> *</span></label>
        </div>
        <?php if (isset($ErrorNomberOfCharOfRegion)) {echo "$ErrorNomberOfCharOfRegion";} ?>
        <div class="form-floating mt-3">
            <textarea class="form-control" placeholder="Description" id="floatingDescription" name="description"
                style="height: 100px"><?=$bottle['description']?></textarea>
            <label for="floatingDescription">Description</label>
        </div>
        <div class="mt-3">
            <label for="image" class="form-label">Changer l'image</label>
            <input class="form-control" type="file" id="image" name="imageBottel" >
        </div>
        <?php if (isset($ErrorNomberOfCharPicture)) {echo "$ErrorNomberOfCharPicture";} ?>
        <?php if (isset($ErrorExtension)) {echo "$ErrorExtension";} ?>
        <?php if (isset($ErrorSize)) {echo "$ErrorSize";} ?>
        <?php if (isset($ErrorUpload)) {echo "$ErrorUpload";} ?>
        <button type="submit" name="modifier" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>