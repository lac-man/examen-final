<?php

session_start();

$user = 'tshirtstore2021!';
$password_definit = 'Tsh2021';

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username&&$password){
    if ($username==$user&&$password==$password_definit){
    $_SESSION['username']=$username;
    header('Location: admin.php');

    }else {
      echo 'Identifiants eronnés';
    }
    
    }else {
        echo 'Veuillez remplir tous les champs !';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>T-shirt store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.google.com/specimen/Montserrat?selection.family=Montserrat&sidebar.open=true" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../style/styles.css">
</head>
<h1> Administration - Connexion </h1>
<form action="" method="POST">
    <h3>pseudo :</h3><input type="texte" name="username"/><br/><br/>
    <h3>Mot de passe :</h3><input type="password" name="password"/><br/><br/>
    <input type="submit" name="submit"/><br/><br/>
</form>



    
