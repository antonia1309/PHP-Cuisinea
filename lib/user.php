<?php
// ici on va faire une requete d insertion qui va integrer les donnees saisies et env via formulaire ds la bdd 
function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password)
{
  $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`) VALUES (:first_name, :last_name, :email, :password, :role);";
  $query = $pdo->prepare($sql);

  //pr hacher/cacher le mot de passe afin de securiser le bdd
  $password = password_hash($password, PASSWORD_DEFAULT);

  $role = 'suscriber';
  $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
  $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->bindParam(':role', $role, PDO::PARAM_STR);
  // param_str: paramètre string et param_int: parametre en entier/chiffre
  return $query->execute();
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{

  // ici on va recup l email de la bdd
  $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
  $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
  $query->execute();
  $user = $query->fetch();
  //var_dump($_POST);pr verifier ce que contient le formulaire env par l utilisateur

  //on verif que email ds mon tab ds ma bdd ci-dessus et identique à email env par l utilisateur via formulaire
  //if ($user && $user['password'] === $_POST['password'])
  // on va verifier si le mdp est idem en version securisée avec le hash:
  if ($user && password_verify($_POST['password'], $user['password'])) {
    return $user;
  } else {
    return false;
  }
}
