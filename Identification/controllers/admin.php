<?php
require_once "bdd_connexion.php";

if (isset($_POST['modifier']) && !empty($_POST['modifier'])) {
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $id = $_POST['id_user'];
        $test = $bdd->prepare("UPDATE user SET nom = :nom , prenom = :prenom , email = :email where id_user = :id ");
        $test->bindValue(':nom', $nom, PDO::PARAM_STR);
        $test->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $test->bindValue(':email', $email, PDO::PARAM_STR);
        $test->bindValue(':id', $id, PDO::PARAM_STR);
        $test->execute();
        //var_dump($test);
        header("location:form_users_list.php?update");
    }

}

if (isset($_POST['supprimer']) && !empty($_POST['supprimer'])){
    $id = $_POST['id_user'];
    $bdd->query("DELETE FROM user where id_user = '$id' ");
    header("location:form_users_list.php?delete");
}

if (isset($_POST['search']) && !empty($_POST['searchValue'])){
    $value = $_POST['searchValue'];
    $result = $bdd->query("SELECT * FROM user where nom like '$value' or prenom like '$value' or email like '$value'");
    $find = $result->fetchAll();
    header("location:form_user_list.php?result");
}