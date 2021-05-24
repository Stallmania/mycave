<?php
require_once('src/controllers/login.php');
ob_start(); 
?>
<br>
<div class="row m-4">
  <div class="col-md-6">
    <img src="public\img\img_key\key_picture.gif" alt="key-picture">
  </div>
  <div class="col-md-6">
    <div class="card bg-white p-3">
        <form action="login.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="admin" name="admin">
                <label for="name">Nom</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Mot de passe</label>
              </div>

              <button type="submit" name="login" class="btn btn-primary mt-3"><i class="bi bi-door-open"></i> Se connecter</button>
        </form>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
require_once('template/layout.html'); 
?>