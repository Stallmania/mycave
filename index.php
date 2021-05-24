<?php
require_once('src/models/cave.php');
require_once('src/models/filtre.php');
require_once('src/controllers/filtreController.php');
require_once('src/controllers/pagination.php');

$years = getYears();
$countries = getCountries();
$regions = getRegions();

$bottles = resultOfData();
$currentPageOfBottles = currentPage();
$pages = nbOfPages();

ob_start(); 
?>

<div class="row">
  <!--SideBar-->
    <div class="col-md-3 bg-light">
      <span class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Chercher par</span>
      </span>
      <hr>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Année
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <ul class="list-group">
                  <?php foreach($years as $year) :?>
                    <li class="list-group-item"><a href="index.php?year=<?= $year['year'] ?>" class=" text-decoration-none"><?= $year['year'] ?></a></li>
                  <?php endforeach ?>
                </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Pays
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul class="list-group">
                  <?php foreach($countries as $country) :?>
                    <li class="list-group-item"><a href="index.php?country=<?= $country['country'] ?>"class=" text-decoration-none"><?= $country['country'] ?></a></li>
                  <?php endforeach ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Région
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <ul class="list-group">
                  <?php foreach($regions as $region) :?>
                    <li class="list-group-item"><a href="index.php?region=<?= $region['region'] ?>"class=" text-decoration-none"><?= $region['region'] ?></a></li>
                  <?php endforeach ?>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!--caroussel et Resultats de recherche-->
    <div class="col-md-9 bg-light">

<!---------Caroussel-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="public\img\img_key\slide-2.jpg" class="d-block w-100" alt="wine-slid">
      <div class="carousel-caption d-none d-md-block">
        <h3>Le domaine de la Source </h3>
        <p>'un des plus petits vignobles de France, niché sur les collines de Nice.AOC depuis 1941, "le Bellet" est rare et ce vin du Sud a du caractère !</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="public\img\img_key\slide-1.jpg" class="d-block w-100" alt="wine-slid">
      <div class="carousel-caption d-none d-md-block">
        <h3>Château Soutard, Saint-Emilion, Bordeaux</h3>
        <p>Les vins, dont la charpente racée n'a d'égal que l'expression du fruit et la finesse des tannins</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="public\img\img_key\slide-3.jpg" class="d-block w-100" alt="wine-slid">
      <div class="carousel-caption d-none d-md-block">
        <h3>Vin de Californie </h3>
        <p> Partez à la découverte des meilleurs vins de Californie au top rapport qualité prix</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="public\img\img_key\slide-4.jpg" class="d-block w-100" alt="wine-slid">
      <div class="carousel-caption d-none d-md-block">
        <h3>Indicazione Geofrafica Tipica</h3>
        <p> C’est un label vaste qui peut recouvrir aussi bien des vins sur l’ensemble d’une région ou d’un cépage sur un territoire</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!---------Les resultats de filtre------>       
      <div class="row row-cols-1 row-cols-md-4 g-4 m-4">
        <?php foreach($bottles as $bottle):?>
          <div class="col-md-3">
              <a href="details_bottle.php?id=<?=$bottle['id_bottle']?>" class="text-decoration-none">
                <div class="card h-100 shadow-sm p-0 mb-1 rounded bg-primary">
                  <img src="public/img/<?=$bottle['picture']?>" class="card-img-top" alt="bottel-picture">
                  <div class="card-body">
                    <h4 class="card-title text-white text-decoration-none"><?=$bottle['name'] ?></h4>
                    <small class="card-text text-white text-decoration-none"><?=substr($bottle['description'],0,60).' ...'?></small>
                  </div>
                </div>
              </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
</div>
<!--Pagination-->
<?php if (empty($_GET) or isset($_GET['page'])):?>
  <div class="m-4 d-flex justify-content-center">
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPageOfBottles == 1) ? "disabled" : "" ?>">
            <a href="./index.php?page=<?= $currentPageOfBottles - 1 ?>&" class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($currentPageOfBottles == $page) ? "active" : "" ?>">
                <a href="./index.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPageOfBottles == $pages) ? "disabled" : "" ?>">
            <a href="./index.php?page=<?= $currentPageOfBottles + 1 ?>" class="page-link">Suivante</a>
        </li>
    </ul>
  </div>
<?php endif ?>

<?php
$content = ob_get_clean();
require_once('template/layout.html'); 
?>