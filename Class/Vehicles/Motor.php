<?php


class Motor extends Vehicle
{
    public function __construct($name, $weight, $color, $registration, $maxSpeed, $maxPassenger)
    {
        parent::__construct($name, $weight, $color, $registration, $maxSpeed, $maxPassenger);
    }
}