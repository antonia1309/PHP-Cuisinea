<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
require_once('lib/tools.php');

$id = (int)$_GET['id'];
#avec le get id: il va recup l index qu on va taper ds l url, ici on va taper ?id=0 pour indiquer la 1ere 
#ligne du tableau soit "mousse au choco" après on va recup les donnees de notre tableau
#var_dump($recipes[$id]);

$recipe = getRecipeById($pdo, $id);
#var_dump ($recipe)pr verif, $recipe: tab qui cprend donnee d'une seule recette; ac var dump on va retrouver ttes les donnees depuis recipes du bdd (description, image,title), reste + qu à les intégrer ci-dessous
#on récupère les recettes avec cette fonction  getRecipeById que nous avons créé ds recipe.php

if ($recipe) {

  $ingredients = linesToArray($recipe['ingredients']);
  $instructions = linesToArray($recipe['instructions']);

  #fontion explode (separateur ici on choisi php eol(end ofline) pr saut de ligne, string dc ingredients);
  # cette fonction retourne un tab de chaine de caracteres
  #ici on a créer une function linesToArray ds tools qui contient explode parlé ci-dessous

?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
  <div class="col-10 col-sm-8 col-lg-6">
    <img src="<?= getRecipeImage($recipe['image']); ?>" class="d-block mx-lg-auto img-fluid"
      alt="<?= $recipe['title']; ?>" width="700" height="500" loading="lazy">
  </div>
  <div class="col-lg-6">
    <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?= $recipe['title']; ?></h1>
    <p class="lead"><?= $recipe['description']; ?></p>
  </div>
</div>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
  <h2>Ingrédients</h2>
  <ul class="list-group">
    <?php foreach ($ingredients as $key => $ingredient) { ?>
    <li class="list-group-item"><?= $ingredient; ?></li>
    <?php }; ?>
  </ul>
</div>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
  <h2>Instructions</h2>
  <ol class="list-group list-group-numbered">
    <?php foreach ($instructions as $key => $instruction) { ?>
    <li class="list-group-item"><?= $instruction; ?></li>
    <?php }; ?>
  </ol>
</div>

<?php } else { ?>
<div class="row text-center">
  <h1>Recette introuvable</h1>
</div>
<?php } ?>

<?php require_once('templates/footer.php'); ?>