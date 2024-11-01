<?php 
include_once "fonctions/fonctionprod.php"; 
include_once "fonctions/fonctioncat.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categorieId = $_GET['id'];
    $categorie = catSelect($mysqlclient, $categorieId);

    if (!$categorie) {

        ?><a href="/cours3/basededonnees/categorie.php">Retour a la liste des catégories </a><?php
        exit;
    }
    if (!$categorie) {
        header("Location: categorie.php");
        exit;
    }
    $produits = produitsParCategorie($mysqlclient, $categorieId);
} else {
    echo "ID de catégorie invalide.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['titre']) && !empty($_POST['prix']) && !empty($_POST['description'])) {
    $prodNew = [
        'titre' => $_POST['titre'],
        'prix' => $_POST['prix'],
        'description' => $_POST['description'],
        'id_categorie' => $categorieId
    ];

    ajoutProd($mysqlclient, $prodNew);

    header("Location: categoriedetail.php?id=" . $categorieId);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Catégorie</title>
    <link rel="stylesheet" href="/cours3/basededonnees/css/style.css">
</head>
<body>
<header>

<a href="/cours3/basededonnees/index.php">Acceuil Formulaire User</a>
    <a href="/cours3/basededonnees/categorie.php">Catégorie</a>

</header>
<h1>Produits</h1>
<div class="formcontent">
<p>Ajout d'un produit</p>
<form action="categoriedetail.php?id=<?php echo $categorieId; ?>" method="POST">
    <input type="text" name="titre" id="titre" placeholder="Titre du produit" required>
    <br>
    <input type="number" name="prix" id="prix" placeholder="Prix du produit" required>
    <br>
    <input type="text" name="description" id="description" placeholder="Description du produit" required>
    <br>
    <input type="submit" value="Ajouter">
</form>
</div>
<h1>Produits de la catégorie : <?php echo htmlspecialchars($categorie['titre']); ?></h1>
<div class="list">
<?php if (count($produits) > 0): ?>
    <ul>
        <?php foreach ($produits as $produit): ?>
            <li><?php echo htmlspecialchars($produit['titre']); ?> - <?php echo htmlspecialchars($produit['prix']); ?> € - <?php echo htmlspecialchars($produit['description']); ?></li>
            <a href="delprod.php?id=<?= $produit['id'] ?>">Supprimer</a>

            <p>-------------------------------------------------</p>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun produit dans cette catégorie.</p>
<?php endif; ?>
</div>
<a href="categorie.php">Retour à la liste des catégories</a>

</body>
</html>
