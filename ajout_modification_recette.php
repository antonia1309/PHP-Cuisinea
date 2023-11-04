<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
require_once('lib/tools.php');
require_once('lib/category.php');


#name ca va etre les donnees qu on va recup au niv serveur dc on recup les donnees avec le name */
#for et id doivent avoir le mm nom car relie le label à l'input 
#enctype qui permet d env des fichiers autres que string 

$errors = [];
$messages = [];
$recipe = [
  'title' => '',
  'description' => '',
  'ingredients' => '',
  'instructions' => '',
  'category_id' => '',
];

$categories = getCategories($pdo);

if (isset($_POST['saveRecipe'])) {
  $fileName = null;
  //var_dump($_FILES['file']['tmp_name']);
  // si un fichier a été envoyé
  if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '') {
    //LA MÉTHoDE GETIMAGESIZE VA RETOURNER FALSE SI LE FICHIER N EST PAS UNE IMAGE
    $checkImage = getimagesize($_FILES['file']['tmp_name']);
    if ($checkImage !== false) {
      // si c une image on traite

      $fileName = uniqid() . '-' . slugify($_FILES['file']['name']);
      //var_dump($fileName);

      move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_ . $fileName);
    } else {
      // sinon on affiche un message d erreur
      $errors[] = 'Le fichier doit être une image';
    }
  }

  if (!$errors) {

    $res = saveRecipe($pdo, $_POST['category'], $_POST['title'],  $_POST['description'], $_POST['ingredients'],  $_POST['instructions'], $fileName);

    if ($res) {
      $messages[] = 'La recette a bien été sauvegardée';
    } else {
      $errors[] = 'La recette n\'a pas été sauvegardée';
    }
  }

  $recipe = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'ingredients' => $_POST['ingredients'],
    'instructions' => $_POST['instructions'],
    'category_id' => $_POST['category'],
  ];
}
?>

<h1>Ajouter une recette</h1>

<?php foreach ($messages as $message) { ?>
<div class="alert alert-success">
  <?= $message; ?>
</div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
<div class="alert alert-danger">
  <?= $error; ?>
</div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="<?= $recipe['title']; ?>">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" cols="30" rows="5"
      class="form-control"><?= $recipe['description']; ?></textarea>
  </div>
  <div class="mb-3">
    <label for="ingredients" class="form-label">Ingrédients</label>
    <textarea name="ingredients" id="ingredients" cols="30" rows="5"
      class="form-control"><?= $recipe['ingredients']; ?></textarea>
  </div>
  <div class="mb-3">
    <label for="instructions" class="form-label">Instructions</label>
    <textarea name="instructions" id="instructions" cols="30" rows="5"
      class="form-control"><?= $recipe['instructions']; ?></textarea>
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Catégorie</label>
    <select name="category" id="category" class="form-select">

      <?php foreach ($categories as $category) { ?>
      <option value="<?= $category['id']; ?>" <?php if ($recipe['category_id'] == $category['id']) {
                                                  echo 'selected="selected"';
                                                } ?>><?= $category['name']; ?>
      </option>

      <?php } ?>

    </select>
  </div>

  <div class="mb-3">
    <label for="file" class="form-label">Image</label>
    <input type="file" name="file" id="file">
  </div>


  <input type="submit" value="Enregistrer" name="saveRecipe" class="btn btn-primary">

</form>



<?php
require_once('templates/footer.php');
?>