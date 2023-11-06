<?php

#ces codes permettent d'utiliser la BDD avec la requête
# from recipes v dire depuis recipes ds la bdd phpmyadmin et 
#code à copier avec le pdo tout en haut de la page:
#code qui permet de recuperer la recette par son identifiant id:
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

function getRecipes(PDO $pdo, int $limit = null)
{
  $sql = 'SELECT * FROM recipes ORDER BY id DESC';
  #cette requête va recup ttes les recettes et les mettre ds l orde la + recente(le +gros id) en 1er.

  if ($limit) {
    $sql .= ' LIMIT :limit';
  }

  $query = $pdo->prepare($sql);

  if ($limit) {
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
  }

  $query->execute();
  return $query->fetchAll();
}

function saveRecipe(PDO $pdo, string $category, string $title, string $description, string $ingredients, string $instructions, string|null $image)
{
  $sql = "INSERT INTO `recipes` (`id`, `category_id`, `title`, `description`, `ingredients`, `instructions`, `image`) VALUES (NULL, :category_id, :title, :description, :ingredients, :instructions, :image);";
  $query = $pdo->prepare($sql);
  $query->bindParam(':category_id', $category, PDO::PARAM_INT);
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->bindParam(':description', $description, PDO::PARAM_STR);
  $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
  $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
  $query->bindParam(':image', $image, PDO::PARAM_STR);
  return $query->execute();
}
