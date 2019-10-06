<?php


class Lion extends Animal implements IAnimal
{
    public function __construct($name, $age, $weight)
    {
        parent::__construct($name, $age, $weight);
    }

    public function hunt(){
        echo "i hunt \n";
    }

    public function eat()
    {
        echo "i eat somme food \n";
    }

    public function older()
    {
        $this->age++;
    }
}