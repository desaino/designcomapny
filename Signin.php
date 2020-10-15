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