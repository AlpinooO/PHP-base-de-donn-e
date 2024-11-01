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

function prodAll($mysqlclient) {
    $sqlQuery = 'SELECT * FROM produits ORDER BY titre ASC';
    $produits = $mysqlclient->prepare($sqlQuery);
    $produits->execute();
    return $produits->fetchAll();
}

function ajoutProd($mysqlclient, $prodNew) {
    if (isset($prodNew['titre'], $prodNew['prix'], $prodNew['description'], $prodNew['id_categorie'])) {
        $sqlQuery = "INSERT INTO produits (titre, prix, description, id_categorie) VALUES (:titre, :prix, :description, :id_categorie)";
        $insertProd = $mysqlclient->prepare($sqlQuery);
        $insertProd->execute([
            'titre' => $prodNew['titre'],
            'prix' => $prodNew['prix'],
            'description' => $prodNew['description'],
            'id_categorie' => $prodNew['id_categorie']
        ]);
    } else {
        echo "Erreur : données manquantes pour ajouter le produit.";
    }
}

function prodSelect($mysqlclient, $id) {
    $sqlQuery = 'SELECT * FROM produits WHERE id = :id';
    $produit = $mysqlclient->prepare($sqlQuery);
    $produit->execute(['id' => $id]);
    return $produit->fetch(PDO::FETCH_ASSOC);
}

function prodUpdate($mysqlclient, $prodUpdate) {
    $sqlQuery = 'UPDATE produits SET titre = :titre, prix = :prix, description = :description, id_categorie = :id_categorie WHERE id = :id';
    $updateProd = $mysqlclient->prepare($sqlQuery);
    $updateProd->execute([
        'id' => $prodUpdate['id'],
        'titre' => $prodUpdate['titre'],
        'prix' => $prodUpdate['prix'],
        'description' => $prodUpdate['description'],
        'id_categorie' => $prodUpdate['id_categorie']
    ]);
}

function prodSuppr($mysqlclient, $id) {
    $sqlQuery = 'DELETE FROM produits WHERE id = :id';
    $deleteProd = $mysqlclient->prepare($sqlQuery);
    $deleteProd->execute(['id' => $id]);
}

if (isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])) {
    $prodSelect = prodSelect($mysqlclient, $_GET['id']);
}

if (isset($_POST) && !empty($_POST)) {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        if (isset($_POST['suppr']) && !empty($_POST['suppr'])) {
            $id = $_POST['id'];
            prodSuppr($mysqlclient, $id);      
        } else {
            $prodUpdate = $_POST;
            prodUpdate($mysqlclient, $prodUpdate);
        }
    } else {
        $prodNew = $_POST;
        ajoutProd($mysqlclient, $prodNew);
    }
}

?>
