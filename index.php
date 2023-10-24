<?php

require_once('templates/header.php');
require_once('lib/recipe.php');

?>


<div class="container col-xxl-8 px-4 py-5">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="assets/images/logo-cuisinea.jpg" class="d-block mx-lg-auto img-fluid" alt="Logo cuisinea" width="550"
        loading="lazy">
    </div>
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Cuisinea - Recettes de cuisine</h1>
      <p class="lead">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page
        avant impression.
        Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme
        assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.
      </p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="recettes.php" class="btn btn-primary">Voir nos recettes</a>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <?php
  foreach ($recipes as $key => $recipe) {
    #var_dump($key);c avec le key que je saurai sur quel recette je me trouve(0)pr mousse au choco/ex
    include('templates/recipe_partial.php');
  } ?>

</div>


<?php require_once('templates/footer.php'); ?>