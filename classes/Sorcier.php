<?php

require_once('./classes/Ennemi.php');

class Sorcier extends Ennemi
{
    public function __construct()
    {
        $this->pol = 3;
        $this->name = "Sorcier";
        $this->power = 25;
        $this->constitution = 12;
        $this->speed = 5;
        $this->xp = 15;
        $this->gold = 30;
    }

    public function runaway()
    {

    }
}