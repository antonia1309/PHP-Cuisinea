<?php
require_once('lib/config.php');
require_once('lib/pdo.php');
require_once('lib/session.php');


#var_dump($_SERVER["SCRIPT_NAME"]);
#nous voulons mettre une page en active avec php pr cela ns avons besoin de recup le index.php et recettes.php avec le server script name on recup cuisinea/index.php
#qd nous sommes sur cette page la page doit devenir active 
#nous allons utiliser basename pr ne recuperer que la fin du lien soit index.php sans le cuisinea/
#echo basename($_SERVER['SCRIPT_NAME']) /le server ns indique la page courante/script name:nom du fichier actuel /basename ns retourne uniquement le nom du fichier;

$currentPage = basename($_SERVER['SCRIPT_NAME']);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/override-bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Cuisinea</title>
</head>

<body>

  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
          <img src="assets/images/logo-cuisinea-horizontal.jpg" alt="Logo cuisinea" width="250">
          <use xlink:href="#bootstrap"></use>
          </svg>
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 nav nav-pills">
        <?php foreach ($mainMenu as $key => $value) { ?>
          <li class="nav-item"><a href="<?= $key; ?>" class="nav-link <?php if ($currentPage === $key) {
                                                                        echo 'active';
                                                                      } ?>"><?= $value; ?></a></li>

        <?php } ?>
      </ul>

      <div class="col-md-3 text-end">
        <?php if (!isset($_SESSION['user'])) { ?>
          <a href="login.php" class="btn btn-outline-primary me-2">Se connecter</a>
          <a href="inscription.php" class="btn btn-outline-primary me-2">S'inscrire</a>
        <?php } else { ?>
          <a href="logout.php" class="btn btn-primary">Se déconnecter</a>
        <?php } ?>
      </div>
    </header>