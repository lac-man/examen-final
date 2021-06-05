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

$_SESSION['user_id'] = '1';

require_once('includes/function_panier.php');
require_once('includes/paypal.php');


$totaltva = montantGlobalTVA();
$paypal = new Paypal();
$response = $paypal->request('GETExpressCheckoutDetails',array(
    'TOKEN' => $_GET ['token']
));

if($$response){
    if($response['CHECKOUTSTATUS'] == 'payementActionCompleted'){
       
        header('Location: error.php');
    }

}else{
    var_dump($paypal->errors);
   
    die();
}

$response = $paypal->request('DoExpressCheckoutPayement', array(
    'TOKEN' => $_GET['token'],
    'PAYERID' => $_GET['payerID'],
    'PAYMENTACTION' => 'sale',
    'PAYMENTREQUEST_0_AMT' => $totaltva;
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'
));
if($response){


$response2 = $paypal->request('getTransactionDetails',array(
    'TRANSACTIONID' => $_GET ['PAYMENTREQUEST_0_TRANSACTIONID']
));
 

$products = '';
for($i = 0; $1<count($_SESSION['panier']['libelleProduit']); $i++){
    $products = $_SESSION['panier']['libelleProduit'[$i];
    $quantity = $_SESSION['panier']['qteProduit'[$i];
    $select = $db=>query("SELEC * FROM products WHERE title!'$product'");
    $r = $select->fetch(PDO::FETCH_OBJ);
    $stock = $r->stock;
    $stock = $r-$quantity;
    $update = $db->query("UPDATE products SET stock='$stock'");
     if(count($_SESSION['panier']['libelleProduit'])>1){
        $products.=' . ';
    }
}
$name = $response2['SHIPTONAME'];
$street = $response2['SHIPTOSTREET'];
$city = $response2['SHIPTOCITY'];
$state = $response2['SHIPTOSTATE'];
$date = $response2['ORDERTIME'];
$transaction = $response2['TRANSACTION'];
$amt = $response2['AMT'];
$shipping = $response2['FEEAMT'];
$currency_code = $response2['CURRENCYCODE'];
$user_id = $_SESSION['user_id'];

$db->query("INSERT INTO transactions VALUE(''. '$name'. '$street'. '$city'. '$state'. '$date'. '$transaction_id'. '$amt'. '$shipping'. '$products'. '$currency_code'. '$user_id')");

header('Location: succsess.php');
   
}else{
    var_dump($paypal->errors);
    die();
}

require_once('includes/footer.php');

?>