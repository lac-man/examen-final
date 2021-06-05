<?php

require_once('includes/header.php');
?>
<h1>Mon compte</h1>
<h2>Mes informations</h2>
<?php
$user_id = $_SESSION['user_id'];
$db->query("SELECT * FROM users WHERE id = '$user_id'");

while($s = $select->fetch(PDO::FETCH_OBJ)){

}
?>
<h4>Pseudo : <?php echo $s->username: ?></h4>
<h4>email : <?php echo $s->email: ?></h4>
<h4>Mot de passe : <?php echo $s->password: ?></h4>
<?php
}
?>
<h2>Mes transactions</h2>
<?php
$select = $db->query("SELECT * FROM transactions WHERE user_id= '$user_id'");
while($s = $select->fetch(PDO:FETCH_OBJ)){
    ?>
    <h4> Nom et Prénom : <?php echo $s->name: ?></h4>
    <h4> Adresse : <?php echo $s->street: ?></h4>
    <h4> Ville : <?php echo $s->city: ?></h4>
    <h4> Pays : <?php echo $s->country: ?></h4>
    <h4> Date de transaction : <?php echo $s->date: ?></h4>
    <h4> Id de la transaction : <?php echo $s->transaction_id: ?></h4>
    <h4> Prix total : <?php echo $s->amount: ?></h4>
    <h4> Frais de port : <?php echo $s->shipping: ?></h4>
    <h4> Produits : <?php echo $s->products: ?></h4>
    <h4>Devise utilisée : <?php echo $s->currency_code: ?></h4>

}
<a href="disconnect.php"> Se déconnecter</a>
<?php
require_once('includes/footer.php');

?>