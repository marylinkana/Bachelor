<?php

function getUsers(){
 require "bdd_connexion.php";
 $get = $bdd->query("SELECT * FROM user");
 return $get->fetchAll();
}

function searchUsers($get, $value){
    require "bdd_connexion.php";
    $result = $bdd->query("SELECT * FROM user where nom like '%$value%' or prenom like '%$value%' or email like '%$value%'");
    return $result->fetchAll();
}