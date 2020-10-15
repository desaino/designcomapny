

    <?php  
   
    if (isset($_POST['formlogin'])) {

        extract($_POST);

     }
 if (!empty($lemail)&& !empty($lpassword))
    {

    	$q = $db ->prepare("SELECT * FROM user WHERE email = :email");
    	$q ->execute (['email' => $lemail]);
    	$result = $q ->fetch();
    	

    	if ($result == true ) {
    		//le compte existe bien 
    	$hashpassword = $result ['password'];
    	if (password_verify($lpassword, $result['password'])) 
    	{
    		echo "le mot de passe est bon , connection en cours";

                     $_SESSION ['email'] = "$result['email']";
                     $_SESSION ['date'] = $result['date']; 

    	}else{
    		echo "le mot de passe n'est pass cottrcte";
    	}

    	}

     else {
     	echo "le compte portant l'email" . $lemail . "n'existe pas";
	   }


    }else
    {
        echo "veuillez completer l'ensemble des champs";
     }


     <?php includes/Login.php  ?>

?>
    