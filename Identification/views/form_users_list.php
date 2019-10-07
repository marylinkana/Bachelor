<?php

$users = getUsers();

if(isset($_GET['update'])){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Modification effectuée!</strong> You should check in on some of those fields below.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}
if(isset($_GET['delete'])){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Suppression effectuée!</strong> You should check in on some of those fields below.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}

?>

<html>
<header>
    <title></title>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</header>
    <body>
      <?php
      if(isset($_GET['Array'])){
          if (!empty($_GET['Array'])){
          ?>
      <h4 align="center">Résultat de la recherche</h4>
        <form action="admin" method="post">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
                </thead>
        <?php
            foreach ($_GET['Array'] as $n => $user){
                ?>
                <tbody>
                <tr>
                    <input type="hidden" name="id_user" id="id_user" value="<?= $user['id_user'] ?>">
                    <th scope="row"><?=$n;?></th>
                    <td><input class="form-control mr-sm-2" type="text" name="nom" id="nom" value="<?= $user['nom'] ?>"></td>
                    <td><input class="form-control mr-sm-2" type="text" name="prenom" id="prenom" value="<?= $user['prenom'] ?>"></td>
                    <td><input class="form-control mr-sm-2" type="text" name="email" id="email" value="<?= $user['email'] ?>"></td>
                    <td><input type="submit" class="btn btn-warning" name="modifier" id="modifier" value="modifier"></td>
                    <td><input type="submit" class="btn btn-danger" name="supprimer" id="supprimer" value="supprimer"></td>
                </tr>
        </form>
                <?php
            }
        }else{
                echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Aucun résultat trouvé!</strong> You should check in on some of those fields below.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        }
      }else{?>
        <h4 align="center">Liste des utilisateurs</h4>
        <form action="admin" method="post">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
                </thead>
        <?php
            foreach ($users as $n => $user){
                ?>
                <tbody>
                <tr>
                    <input type="hidden" name="id_user" id="id_user" value="<?= $user['id_user'] ?>">
                    <th scope="row"><?=$n;?></th>
                    <td><input class="form-control mr-sm-2" type="text" name="nom" id="nom" value="<?= $user['nom'] ?>"></td>
                    <td><input class="form-control mr-sm-2" type="text" name="prenom" id="prenom" value="<?= $user['prenom'] ?>"></td>
                    <td><input class="form-control mr-sm-2" type="text" name="email" id="email" value="<?= $user['email'] ?>"></td>
                    <td><input type="submit" class="btn btn-warning" name="modifier" id="modifier" value="modifier"></td>
                    <td><input type="submit" class="btn btn-danger" name="supprimer" id="supprimer" value="supprimer"></td>
                </tr>
        </form>
                <?php
            }
      }
      ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>