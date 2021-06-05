<?php

session_start();

try{
    $db = new PDO('mysql:host=localhost;dbname=tshirtstore', 'root','');
    $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

die('Une erreur est survenue');


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
  <header>
   <br/><h1>T-SHIRT STORE</h1><br/>

    <ul class="menu">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="boutique.php">Boutique</a></li>
        <li><a href="panier.php">Panier</a></li>
       <?php if(!isset($_SESSION['user_id'])){?>
       <li><a href="register.php">S'inscrire</a></li>
       <li><a href="connect.php">Se connecter</a></li>
       <?php }else{ ?>
       <li><a href="my_account.php">Mon compte</a></li>
       <?php  } ?>
       <li><a href="conditions_generales_de_vente.php">Conditions générales de vente</a></li>
   </ul>

  </header>
</html>