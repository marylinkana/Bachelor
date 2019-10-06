<?php
 require_once "Animal.php";
    require_once "Lion.php";

class Main
{

}

$animal = new Animal("animalinio", "7 mois", "100 kg");
echo $animal->getName()."\n";
$animal->eat();

$lion = new Lion("lioninio", "7 mois", "100 kg");
echo $lion->getName()."\n";
$lion->hunt();
$lion->eat();