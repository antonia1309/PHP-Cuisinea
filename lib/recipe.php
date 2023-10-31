<?php

#ces codes permettent d'utiliser la BDD avec la requête
# from recipes v dire depuis recipes ds la bdd phpmyadmin et 
#code à copier avec le pdo tout en haut de la page:
function getRecipeById(PDO $pdo, int $id)
{
  $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
  return $query->fetch();
}

function getRecipeImage(string|null $image)
{
  if ($image === null) {
    return _ASSETS_IMG_PATH_ . 'recipe_default.jpg';
  } else {
    return _RECIPES_IMG_PATH_ . $image;
  }
}
