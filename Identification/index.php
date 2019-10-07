<?php
session_start();
require 'bdd_connexion.php';
if(!isset($_GET['p']) || $_GET['p'] == "")
{
    $page = "accueil";
}
else
{
    $page = 404;
    if(file_exists("controllers/".$_GET['p'].".php"))
    {
        $page = $_GET['p'];
    }
}
ob_start();//suspend l'affichage
require "controllers/".$page.".php";
$content = ob_get_contents();//recupere ce qui n'a pas ete affiché
ob_end_clean();//reprend l'affichage
require "layout.php";
?>
