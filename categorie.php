<?php 
include_once "fonctions/fonctioncat.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Catégories</title>

    <link rel="stylesheet" href="/cours3/basededonnees/css/style.css">
</head>
<body>
<header>

<a href="/cours3/basededonnees/index.php">Acceuil Formulaire User</a>
    <a href="/cours3/basededonnees/categorie.php">Catégorie</a>

</header>
<h1>Catégories:</h1>
<div class="formcontent">
    <p>Ajout d'une catégorie:</p>

<form action="categorie.php" method="POST">
    <input type="text" name="titre" id="titre" placeholder="Titre de la catégorie" required>
    <br>
    <input type="submit" value="Ajouter">
</form>
</div>
<div class="list">
<h2>Liste des Catégories</h2>
<?php
$categories = catAll($mysqlclient);
if (count($categories) > 0) {
    foreach ($categories as $categorie) { ?>
        <p>
            <a href="categoriedetail.php?id=<?= $categorie['id'] ?>">
                <?= htmlspecialchars($categorie['titre']); ?>
            </a> 
            <br>
            <a href="editcat.php?id=<?= $categorie['id'] ?>">Editer</a> |
            <a href="delcat.php?id=<?= $categorie['id'] ?>">Supprimer</a>
            <p>-------------------------------------------------</p>
        </p>
    <?php }
} else {
    echo "<p>Aucune catégorie disponible.</p>";
}
?>
</div>
</body>
</html>
