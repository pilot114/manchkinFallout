<?php

namespace ManchkinFallout;

class Manchkin
{
    public $level;
    public $class;
    public $gender;
    public $damage;

    public $leftHand;
    public $rightHand;

    public $extraClass;
    public $extraHand;

    public $activeCard;
    public $handCard;

    // bool
    public $fullArmor    = false;
    public $fullHelmet   = false;
    public $fullBoots    = false;
    public $fullHands    = false;
    public $homestraight = false;


    public function __construct($startCards, $gender)
    {
        $this->level = 1;
        $this->damage = 1;
        $this->gender = $gender;
        $this->handCard = $startCards;
    }
}