<?php

function getUsers(){
 require "bdd_connexion.php";
 $get = $bdd->query("SELECT * FROM user");
 return $get->fetchAll();
}
