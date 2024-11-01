<?php include_once "fonctions/fonctionprod.php";
include_once "fonctions/fonctioncat.php";
?>

<?php

$produitId = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edition</title>
  <link rel="stylesheet" href="/cours3/basededonnees/css/style.css">

</head>
<body>
<header>

<a href="/cours3/basededonnees/index.php">Acceuil Formulaire User</a>
    <a href="/cours3/basededonnees/categorie.php">Catégorie</a>

</header>
<h1>Formulaire de suppression</h1>

<?php
if($prodSelect){ ?>
<form action="categoriedetail.php?id=<?php echo $produitId; ?>" method="POST">
  <input type="hidden" name="id" value="<?=$prodSelect['id']?>">
  <input type="hidden" name="suppr" value="1">
  <input type="submit" value="La suppression est définitive">
</form>
<?php
}

?>
  
</body>
</html>