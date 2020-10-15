<?php session_start();
//ajouter
setcookie('pseudo', 'graven' ,time()+(30+24+3600));
setcookie('id', 18, time() + 60 );
 
if (isset($_COOKIE['age'])) {
     echo "l'element existe bien" . $_COOKIE['pseudo'];
 } 
 else {
    echo "l'element n'existe pas";
 }



  ?>


<!DOCTYPE html>
<html>
<head>
	<title>titre</title>
</head>
<body>
   
    <h1>binvenue sur votre profil</h1>
   <?php 
      if (isset($_SESSION['email']) && (isset($_SESSION['date']))) {

        ?>
         <p>votre email : <?= $_SESSION['email']; ?> </p>
         <p>votre date :<?= $_SESSION['date']; ?> </p>
         <?php
      }else{
        echo "Veuillez vous connectez à votre  compte";
      }
?> 
  <!-- Menu de navigation -->

	
<?php include 'menunavigation.php'; 
include 'includes/database.php';
     global $db;
     ?>

	
	<h1>Login</h1>
    <form method="post">
         <input type="email" name="lemail" id="lemail" placeholder="Votre email" required><br/>
          <input type="password" name="lpassword" id="lpassword" placeholder="Votre mot de pass" required><br/>
        
    	
    	<input type="submit" name="formlogin" id="formlogin" value="Login">
    </form>

<? php includes/Login.php ?>

 

   <h1>Signin</h1>
 <form method="post">
         <input type="email" name="semail" id="semail" placeholder="Votre email" required><br/>
          <input type="password" name="password" id="password" placeholder="Votre mot de pass" required><br/>
         <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer votre mot de pas" required><br/>
        
        <input type="submit" name="formsend" id="formsend" value="Signin">
    </form>   
    
<?php  include 'includes/Signin.php'; ?>
<?php
   
    if (isset($_POST['formsend'])) {

        extract($_POST);


 if (!empty($password)&& !empty($cpassword)&& !empty($semail)){

     if ($password == $cpassword) {


        $options = [
        'cost' =>12,
    ];
    $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
     include 'includes/database.php';
     global $db;

     $c = $db ->prepare("SELECT email FROM users WHERE email =:email");
     $c ->execute(['email'=> $semail]);

    
    $result = $c ->rowCount();

    echo $result;

    if($result==0){
         $q = $db ->prepare("INSERT INTO users(email,password (values(:email,:password)");
     $q->execute([
        'email' => $email,
        'password' => $hashpass
    ]);
     echo "le compte a été céée";
    }else{
        echo "un Email existe deja !";
    }


    
     }

    
     }else{
        echo "les champs ne sont pas remplies";
     }


     } 

?>
</body>
</html>