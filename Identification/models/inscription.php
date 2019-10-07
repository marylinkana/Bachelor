<?php

use phpDocumentor\Reflection\Location;

require "bdd_connexion.php";

if(isset($_SESSION['data'])){
    $_SESSION['data'] = [];
}

if(isset($_POST['submit']) && !empty($_POST['submit'])){
   register($_POST);
}

function register($reg) {
    global $bdd;
    $nom =  htmlspecialchars($reg['nom']);
    $prenom =  htmlspecialchars($reg['prenom']);
    $email =  htmlspecialchars($reg['email']);
    $mdp =  sha1(htmlspecialchars($reg['mdp']));



    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $email)){
        echo "<p class='text-danger'>invalid email</p>";
        return "<p class='text-danger'>invalid email</p>";
    }
    else{
     // Verification de l'email eMail - Est-elle deja enregistrer ????
     $email_nouvelle = "SELECT id_user FROM user WHERE email='".$email."'";
     $resultat = $bdd->prepare($email_nouvelle);
     $resultat->execute();
     $nombre_email = $resultat->rowCount();

     if($nombre_email == 0){
       // Enregistrement de l'utilisateur dans la base de donnees
       $req_insert_user = $bdd->prepare("INSERT INTO user (nom, prenom, mdp, email)
                                         VALUES (:nom, :prenom, :mdp, :email) " );
       $req_insert_user->bindValue(':nom', $nom, PDO::PARAM_STR);
       $req_insert_user->bindValue(':prenom', $prenom, PDO::PARAM_STR);
       $req_insert_user->bindValue(':mdp', $mdp, PDO::PARAM_STR);
       $req_insert_user->bindValue(':email', $email, PDO::PARAM_STR);
       $test = $req_insert_user->execute();
       //var_dump($test);
       header("location:../views/form_users_list.php");
       return $test;
     }
     else{
         echo "<p class='text-danger'>email already exist</p>";
         return "<p class='text-danger'>email already exist</p>";
     }
    }
}