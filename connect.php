<?php

require_once('includes/header.php')


if(isset($_SESSION['user_id'])){

if(isset($_POST['submit'])){

  
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email&&$password){
        $select = $db->query("SELECT id FROM users WHERE email='$email'");
        if($select->fetchColum()){
            $select = $db->query("SELECT * FROM users WHERE email='$email'");
            $result = $select->fetch(PDO::FETCH_OBJ);
            $_SESSION['user_id'] = $result->id;
            $_SESSION['user_name'] = $result->username;
            $_SESSION['user_email'] = $result->email;
            $_SESSION['user_password'] = $result-password;
            header('my_account.php');
        }else{
            echo '<br/><h4 style="color:red;">Identifiants incorrect</h4>';
            }
          
    }else{
    echo '<br/><h4 style="color:red;">Veuillez remplir tous les champs</h4>';
    }

}

?>

<br/>
<h1>Se connecter</h1>

<form action="" method="POST">
<h4>Votre e-mail <input type="email" name="email"/></h4>
<h4>Votre mot de passe <input type="password" name="password"/></h4>
<input type="submit" name="submit"/>
</form>
<a href="register.php">S'inscrire</a>
<br/>
<?php

}else{
    header('Location:my_account.php')
}

require_once('includes/footer.php')

?>