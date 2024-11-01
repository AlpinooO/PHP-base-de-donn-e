<?php include_once "fonctions/fonctions.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/cours3/basededonnees/css/style.css">
</head>
<body>

<header>

    <a href="/cours3/basededonnees/index.php">Acceuil Formulaire User</a>
    <a href="/cours3/basededonnees/categorie.php">Catégorie</a>

</header>


<h1>Base de données</h1>


<h2>Produit</h2>
<div class="formcontent">
<p>Formulaire pour les utilisateurs</p>
<form action="index.php" method="POST">
  <input type="text" name="nom" id="nom" placeholder="nom">
  <br>
  <input type="text" name="prenom" id="prenom" placeholder="prenom">
  <br>
  <input type="number" name="age" id="age" placeholder="age">
  <br>
  <input type="submit" value="envoyer">
</form>
</div>
<h2>Liste des users</h2>
<div class="list">
<?php 
  $users = userAll($mysqlclient);

  if( count($users) > 0){
    foreach($users as $key => $user){ ?>
        <p><?php echo $user['id'].' | '.$user['nom'].' | '.$user['prenom'].' | '.$user['age'].' ans ';  ?></p>
        <p><a href="edit.php?id=<?=$user['id']?>">Editer</a> | <a href="del.php?id=<?=$user['id']?>">Supprimer</a></p>
        <p>-------------------------------------------------</p>
<?php
    }

  }else{
    echo "<p>Pas d'utilisateurs inscrit</p>";
  }

?>

</div>
  <footer>
    

  </footer>
</body>
</html>