
<?php

require_once "Vehicle.php";
require_once "Motor.php";
require_once "Truck.php";
require_once "Car.php";

$motor = new Motor("toyota1", "150kg", "red", "012345",
    "300km/h", "2");

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>
<table class="table table-striped table-dark">
    <thead>
    <tr>
        <th scope="col"><i class="fas fa-motorcycle"></i><?= $motor->toString();?>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row"><?= $motor->start();?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->getPassenger();?></th>
    </tr>
    <tr>
        <th scope="row"><?=$motor->monter(2);?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->drive();?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->getSpeed();?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->setSpeed(100);?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->getSpeed();?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->park();?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->descendre(1);?></th>
    </tr>
    <tr>
        <th scope="row"><?= $motor->getPassenger();?></th>
    </tr>
    </tbody>
</table>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
