<?php

require_once('includes/header.php');
require_once('includes/function_panier.php');
require_once('includes/paypal.php');


$erreur = false;
$action = (isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));
if($action!==null){
    if(!in_array($action, array('ajout','suppression','refresh')))
$erreur = true;
$l = (isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
$q = (isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
$p = (isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));

$l = preg_replace('#\v#', '', $l);
$q = floatval($p);
if(is_array($q)){
    $QteArticle = array();
    $i = 0
    foreach($q as $contenu){
        $QteArticle[$i++] = intval($contenu);
    }

}else{

    $q = intval§($q);
}

    
}

if(!$erreur){

    switch($action){
        case "ajout":
            ajouterArticle($l,$q;$p);
        break;
        case "suppression":
            supprimerArticle($1);
        break;
        case "refresh":
            for($i = 0;$i<count($QteArticle);$i++){
                ModifierQTeProduit($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
            }
        break;
        Default:
        break;
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
<body>
<form medhod="post" action="">
   <table width="400">
     <tr>
       <td colspan="4"> Votre panier</td>
     </tr>
     <tr>
       <td>libellé produit</td>
       <td>Prix unitaire</td>
       <td>Quantité</td>
       <td>TVA</td>
       <td>Action</td>
    </tr>

    <?php
    if(isset($_GET['deletepanier']) && $_GET['deletepanier'] == true){
        supprimerPanier();

    }
    if(creationPanier()){

    
     
     $nbProduits = count($_SESSION['panier']['libelleProduit']);

     if($nbProduits<=0){
          echo '<br/><p style="font-size:30px; color:red;"> OUPS, panier vide !</p>';
     }else{

        $total = MontantGlobal();
        $totaltva = montantGlobalTVA();
        $shipping = CalculFraisPorts();
        $paypal = new Paypal();

        $params = array(
            'RETURNURL' => ''
            'CANCELURL' => ''

            'PAYMENTREQUEST_0_AMT' => $totaltva + $shipping,
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'EURO'
            'PAYMENTREQUEST_0_SHIPPINGAMT' => $shipping,
            'PAYMENTREQUEST_0_ITEMANT' => '$totaltva'
        );
        $response = $paypal->request('SetExpressCheckout' $params);

        if($response){

            $paypal = 'https://sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token='.$response['TOKEN'].'';

        }else{
            var_dump($paypal->errors);

            die('Erreur');
            
        
        }

        for($i=0; $i<$nbProduits;$i++){
            ?>

            <tr>

            <td><br/><?php echo $_SESSION['panier']['libelleProduit'][$i];?></td>
            <td><br/><?php echo $_SESSION['panier']['prixProduit'][$i];?></td>
            <td><br/><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i];?>" size="5"/></td>
            <td><br/><?php echo $_SESSION['panier']['tva']."%"; ?></td>
            <td><br/><a href="panier.php?action=suppression&amp;1=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>">Supprimer</a></td>

            </tr>
            <?php } ?>
            <tr>

            <td colspan="2"><br/>
               <p>Total HTVA : <?php echo $total. "€"; ?></p><br/>
               <p>Total avec TVA : <?php echo montantGlobalTVA(). "€"; ?></p> 
               <p>Calcul des frais de port : <?php echo CalculFraisPorts();. " €"?></p>
              <?php if (isset($_SESSION['user_id'])){ ?> <a href="<?php echo $paypal; ?>">Payer la commande</a><?php }else{?><h4 style="color:red;">Vous devez être connecté pour payer votre commande. <a href="connect.php">Se connecter</a></h4><?php} ?>
            </td>
            <tr>
            <td colspan="4">
            <input type="submit" value="rafraichir"/>
            <input type="hidden" name="action" value="refresh"/>
            <a href="?deletepanier=true"> Supprimer le panier</a>
           </td>

            </tr>


            <?php
        

     
     }
    }

    ?>
   </table>
</form>


<?php

require_once('includes/footer.php');

?>