<?php
require_once "Vehicle.php";
require_once "Motor.php";
require_once "Truck.php";
require_once "Car.php";

class Main
{
}
    $motor = new Motor("toyota1", "150kg", "red", "012345",
                    "300km/h", "2");
    echo $motor->toString();
    echo $motor->start();
    echo $motor->getPassenger()."\n";
    echo $motor->monter(2);
    echo $motor->getPassenger()."\n";
    echo $motor->ride();
    echo $motor->getSpeed();
    echo $motor->setSpeed(100);
    echo $motor->getSpeed();
    echo $motor->park();
    echo $motor->descendre(1);
    echo $motor->getPassenger()."\n";



