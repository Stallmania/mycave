<?php
$pageTitle = 'Listes des bouteilles';
require_once('src/controllers/session_control.php');
forecer_utilisateur_connceter();
require_once('src/models/cave.php');
require_once('src/controllers/pagination.php');

$bottles = getBottles();
$pages = nbOfPages();
$currentPageOfBottles = currentPage();
ob_start();
?>
<span class="sticky-top">
    <a href="add_bottle.php" class="btn btn-primary m-1">Ajouter une bouteille</a>
</span>

<span class="">
    <a href="admin_crud.php" class="btn btn-dark m-1">Gestion des administrateurs</a>
</span>



<?php foreach ($bottles as $key=>$bottle) : ?>
    <div class="row bg-primary mb-3 p-1">
        <div class="col-md-10 p">
            <div class="row">
                <div class="col-md-3 p-1">    
                    <img src="public/img/<?=$bottle['picture']?>" class="mx-auto d-block rounded" style="max-width:200px;" alt="wine-picture">
                </div>
                <div class="col-md-9 pt-1 bg-primary">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nom </strong><?= $bottle['name'] ?></li>
                        <li class="list-group-item"><strong>Année </strong><?= $bottle['year'] ?></li>
                        <li class="list-group-item"><strong>grappe </strong><?= $bottle['grapes'] ?></li>
                        <li class="list-group-item"><strong>Pays </strong><?= $bottle['country'] ?></li>
                        <li class="list-group-item"><strong>Région </strong><?= $bottle['region'] ?></li>
                    </ul>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bg-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#A<?=$key?>B" aria-expanded="false" aria-controls="A<?=$key?>B">
                                    Description
                                </button>
                            </h2>
                            <div id="A<?=$key?>B" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body bg-white">
                                    <p><?= $bottle['description']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-md-2 p-2 bg-primary">
            <div class="m-2 text-center">
                <a href="upd_bottle.php?id_bottle=<?= $bottle['id_bottle'] ?>" class="btn btn-info">Editer</a>
            </div>
            <div class="m-2 text-center">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-Warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Supprimer
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Confirmer-vous la suppression de la bouteille !
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a href="del_bottle.php?id_bottle=<?= $bottle['id_bottle'] ?>" class="btn btn-Warning">Supprimer</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="m-4 d-flex justify-content-center">
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPageOfBottles == 1) ? "disabled" : "" ?>">
            <a href="./bottles_crud.php?page=<?= $currentPageOfBottles - 1 ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($currentPageOfBottles == $page) ? "active" : "" ?>">
                <a href="./bottles_crud.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPageOfBottles == $pages) ? "disabled" : "" ?>">
            <a href="./bottles_crud.php?page=<?= $currentPageOfBottles + 1 ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html');
?>