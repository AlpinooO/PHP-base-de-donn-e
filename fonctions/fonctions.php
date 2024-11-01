<?php
try{

  $mysqlclient = new PDO('mysql:host=localhost;dbname=b2dev2;charset=utf8', 'root', 'oscarlechat666', 
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

}
catch(Exception $e){
  die('Erreur : '.$e->getMessage());
}

function ajoutUser($mysqlclient, $userNew){
  $sqlQuery = "INSERT INTO users(nom, prenom, age) VALUES(:nom, :prenom, :age)";
  $insertUser = $mysqlclient->prepare($sqlQuery);
  $insertUser->execute([
    'nom' => $userNew['nom'],
    'prenom' => $userNew['prenom'],
    'age' => $userNew['age'],
  ]);
}

function userAll($mysqlclient){
  $sqlQuery = 'SELECT * FROM users ORDER BY nom ASC';
  $users = $mysqlclient->prepare($sqlQuery);
  $users->execute();
  return $users->fetchAll();
}


function userSelect($mysqlclient, $id){
  $sqlQuery = 'SELECT * FROM users WHERE id = '.$id.'';
  $user = $mysqlclient->prepare($sqlQuery);
  $user->execute();
  return $user->fetch(PDO::FETCH_ASSOC);

}


function  userUpdate($mysqlclient,$userUpdate){
  $sqlQuery = 'UPDATE users SET nom = :nom, prenom = :prenom, age = :age WHERE id = :id ';
  $updateUser = $mysqlclient->prepare($sqlQuery);
  $updateUser->execute([
    'id' => $userUpdate['id'],
    'nom' => $userUpdate['nom'],
    'prenom' => $userUpdate['prenom'],
    'age' => $userUpdate['age']
  ]);
}

function  userSuppr($mysqlclient, $id){
  $sqlQuery = 'DELETE FROM users WHERE id ='.$id.'';
  $user = $mysqlclient->prepare($sqlQuery);
  $user->execute();
}

if(isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])){
    $userSelect = userSelect($mysqlclient, $_GET['id']);
  }


if(isset($_POST) && !empty($_POST)){
  if(isset($_POST['id']) && !empty($_POST['id'])){
    if(isset($_POST['suppr']) && !empty($_POST['suppr'])){
      $id = $_POST['id'];
      userSuppr($mysqlclient, $id);      

    }else{
      $userUpdate = $_POST;
      userUpdate($mysqlclient,$catUpdate);
    }

  }else{
    $userNew = $_POST;
    ajoutUser($mysqlclient,$userNew);
  }

}
