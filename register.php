<?php

require_once('includes/header.php')
if(isset($_SESSION['user_id'])){

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];
    

    if($username&&$email&&$password&&$repeatpassword){
        if($password==$repeatpassword){
            $db=>query("INSERT INTO users VALUES('', '$username', '$email','$password')");
         echo   '<br/><h4 style="color:green;">Vous avez créé votre compte vous pouvez maintenant vous<a href="connect.php">connecter</a></h4>';
        }else{
            echo '<br/><h4 style="color:red;">Les mots de passe ne sont pas identiques</h4>';
        }
        
    }else{
    echo '<br/><h4 style="color:red;">Veuillez remplir tous les champs</h4>';
    }

}

?>

<br/>
<h1>S'enregistrer</h1>

<form action="" method="POST">
<h4>Votre pseudo <input type="text" name="username"/></h4>
<h4>Votre e-mail <input type="email" name="email"/></h4>
<h4>Votre mot de passe <input type="password" name="password"/></h4>
<h4>Répétez votre mot de passe<input type="password" name="password"/></h4>
<input type="submit" name="submit"/>
</form>
<a href="connect.php">Se connecter</a>
<br/>
<?php

}else{
    header('Location:my_account.php')
}

require_once('includes/footer.php')

?>