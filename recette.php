<?php
require_once('templates/header.php');
require_once('lib/recipe.php');

$id = $_GET['id'];
#avec le get id: il va recup l index qu on va taper ds l url, ici on va taper ?id=0 pour indiquer la 1ere 
#ligne du tableau soit "mousse au choco" après on va recup les donnees de notre tableau
#var_dump($recipes[$id]);

?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
  <div class="col-10 col-sm-8 col-lg-6">
    <img src="<?= _RECIPES_IMG_PATH_ . $recipes[$id]['image'] ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
  </div>
  <div class="col-lg-6">
    <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?= $recipes[$id]['title'] ?></h1>
    <p class="lead"><?= $recipes[$id]['description'] ?></p>

  </div>

</div>


<?php require_once('templates/footer.php'); ?>