<?php


class Vehicle
{
    private $name, $weight, $color, $registration, $maxSpeed, $speed, $maxPassenger, $passenger ;

    function __construct($name, $weight, $color, $registration, $maxSpeed, $maxPassenger)
    {
        $this->setName($name);
        $this->setWeight($weight);
        $this->setColor($color);
        $this->setRegistration($registration);
        $this->setMaxSpeed($maxSpeed);
        $this->setMaxPassenger($maxPassenger);
        $this->initPassenger(0);
        $this->initSpeed(0);

    }

    public function initPassenger($passenger){
        $this->passenger = $passenger;
    }

    public function initSpeed($speed){
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @param mixed $registration
     */
    public function setRegistration($registration): void
    {
        $this->registration = $registration;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->getName()." drive at : ".$this->speed."km/h\n";
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed): void
    {
        if($this->maxSpeed >= $this->speed + $speed) {
            $this->speed += $speed;
            echo "speed has been setted\n";
        }

    }

    /**
     * @return mixed
     */
    public function getMaxPassenger()
    {
        return $this->maxPassenger;
    }

    /**
     * @param mixed $maxPassenger
     */
    public function setMaxPassenger($maxPassenger): void
    {
        $this->maxPassenger = $maxPassenger;
    }

    /**
     * @return mixed
     */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    /**
     * @param mixed $maxSpeed
     */
    public function setMaxSpeed($maxSpeed): void
    {
        $this->maxSpeed = $maxSpeed;
    }

    /**
     * @return mixed
     */
    public function getPassenger()
    {
        return $this->getName()." have ".$this->passenger." passenger(s)";
    }

    /**
     * @param mixed $passenger
     */
    public function setPassenger($passenger): void
    {
        if(($this->maxPassenger >= $this->passenger + $passenger) && $this->passenger + $passenger >= 0 ) {
            $this->passenger += $passenger;
        }

    }

    public function toString(){
        echo "Type : ".get_class($this).", Nom : ".$this->getName().", Weight : ".$this->getWeight().", Coulor : ".$this->getColor().", Registration : ".$this->getRegistration().
            ", Max passenger : ".$this->getMaxPassenger().", Max speed : ".$this->getMaxSpeed()."\n";
    }

    public function start(){
        echo $this->getName()." is started \n";
    }

    public function fix(){
        echo $this->getName()." is fixed \n";
    }

    public function drive(){
        echo "Maneuvering to drive -> ";
        $this->setSpeed($this->speed++);
        echo $this->getName()." is driving \n";
    }

    public function park(){
        echo "Maneuvering to park -> ";
        $this->setSpeed(-$this->speed);
        echo $this->getName()." is parked\n";
    }

    public function distanceTraveled($time){
        if (is_int($time)){
            echo $this->getName()." a parcouru : ".$time * $this->getSpeed()."km/h";
        }
        return "the time must be numbers\n";
    }

    public function monter($nb){
        $this->setPassenger($nb);
        echo $nb." passagé(s) monté(s)\n";
    }

    public function descendre($nb){
        $this->setPassenger(-$nb);
        echo $nb." passagé(s) descendu(s)\n";
    }

}