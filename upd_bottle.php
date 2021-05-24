<?php
$pageTitle = 'Editer une bouteille';
require_once('src/controllers/upd_bottle.php');

ob_start();
?>

<div class="card p-3">
    <h1 class="text-primary text-uppercase">modifier les information sur une bouteille</h1>
    <form action="upd_bottle.php?id_bottle=<?=$bottle['id_bottle'] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <img src="public/img/<?=$bottle['picture'] ?>" alt="picture">
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$bottle['name'] ?>" name="name" placeholder="Nom">
            <label for="floatingName">Nom</label>
        </div>
        <div class="form-floating">
            <input type="number" class="form-control" id="floatingSite" value="<?=$bottle['year'] ?>" name="year" placeholder="année">
            <label for="floatingSite">Année</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$bottle['grapes'] ?>" name="grapes" placeholder="grapes">
            <label for="floatingName">grapes</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingSite" value="<?=$bottle['country'] ?>" name="country" placeholder="pays">
            <label for="floatingSite">pays</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" value="<?=$bottle['region'] ?>" name="region" placeholder="région">
            <label for="floatingName">région</label>
        </div>
        <div class="form-floating mt-3">
            <textarea class="form-control" placeholder="Description" id="floatingDescription" value="<?=$bottle['description']?>" name="description"
                style="height: 100px"></textarea>
            <label for="floatingDescription">Description</label>
        </div>
        <div class="mt-3">
            <label for="image" class="form-label">Changer l'image</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>

        <button type="submit" name="modifier" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>