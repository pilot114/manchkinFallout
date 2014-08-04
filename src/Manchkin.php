<?php

namespace ManchkinFallout;

class Manchkin
{
    public $level;
    public $class;
    public $gender;
    public $damage;

    public $countHand = 2;

    public $activeCard;
    public $handCard;

    // bool
    public $fullHead = false;
    public $fullShield = false;
    public $fullBoots = false;
    public $fullHands = false;

    public function __construct($startCards, $gender)
    {
        $this->level = 1;
        $this->damage = 1;
        $this->gender = $gender;
        $this->handCard = $startCards;
    }
}