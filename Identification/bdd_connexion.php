<?php
$url = "localhost";
$bddname = "identification";
$bdduser = "root";
$bddmdp = "";

try
{
    $bdd = new PDO("mysql:host=".$url.";dbname=".$bddname.";charset=utf8",$bdduser,$bddmdp);
}
catch(PDOException $e)
{
    print "Erreur ! : " . $e->getMessage() . "<br/>";
    die("bdd non trouvée");
}
?>