<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $mysqlclient = new PDO('mysql:host=localhost;dbname=b2dev2;charset=utf8', 'root', 'oscarlechat666', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
}

function catAll($mysqlclient) {
    $sqlQuery = 'SELECT * FROM categories ORDER BY titre ASC';
    $categories = $mysqlclient->prepare($sqlQuery);
    $categories->execute();
    return $categories->fetchAll();
}


function ajoutCat($mysqlclient, $catNew) {
    $sqlQuery = "INSERT INTO categories(titre) VALUES (:titre)";
    $insertCat = $mysqlclient->prepare($sqlQuery);
    $insertCat->execute(['titre' => $catNew['titre']]);
}

function catSelect($mysqlclient, $id) {
    $sqlQuery = 'SELECT * FROM categories WHERE id = :id';
    $category = $mysqlclient->prepare($sqlQuery);
    $category->execute(['id' => $id]);
    return $category->fetch(PDO::FETCH_ASSOC);
}

function catUpdate($mysqlclient, $catUpdate) {
    $sqlQuery = 'UPDATE categories SET titre = :titre WHERE id = :id';
    $updateCat = $mysqlclient->prepare($sqlQuery);
    $updateCat->execute([
        'id' => $catUpdate['id'],
        'titre' => $catUpdate['titre'],
    ]);
}

function catSuppr($mysqlclient, $id) {
    $sqlQuery = 'DELETE FROM categories WHERE id = :id';
    $deleteCat = $mysqlclient->prepare($sqlQuery);
    $deleteCat->execute(['id' => $id]);
}

function produitsParCategorie($mysqlclient, $categorieId) {
    $sqlQuery = 'SELECT * FROM produits WHERE id_categorie = :id_categorie';
    $produits = $mysqlclient->prepare($sqlQuery);
    $produits->execute(['id_categorie' => $categorieId]);
    return $produits->fetchAll();
}

if(isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])){
    $catSelect = catSelect($mysqlclient, $_GET['id']);
  }


if(isset($_POST) && !empty($_POST)){
  if(isset($_POST['id']) && !empty($_POST['id'])){
    if(isset($_POST['suppr']) && !empty($_POST['suppr'])){
      $id = $_POST['id'];
      catSuppr($mysqlclient, $id);      

    }else{
      $userUpdate = $_POST;
      catUpdate($mysqlclient,$userUpdate);
    }

  }else{
    $catNew = $_POST;
    ajoutCat($mysqlclient,$catNew);
  }

}

?>
