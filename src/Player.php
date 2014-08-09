<?php

namespace ManchkinFallout;

class Player extends \SplObjectStorage
{
    public $resourceId;
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

    public $game;

    public $abilityes; // special button, except special events

    public function __construct($startCards, $gender)
    {
        $this->level = 1;
        $this->damage = 1;
        $this->gender = $gender;
        $this->handCard = $startCards;
    }

    public function modDamage($mod){
        $this->damage += $mod;
    }

    /*
     *      CARD ACTIONS
     */
    public function addCard($cards)
    {

    }

    public function playCard($cardId)
    {

    }

    public function dropCard($count, $selector, $interactiveMode = false)
    {
        if ($interactiveMode) {
            return $this->activeCard;
        } else {
            return $this->activeCard;
        }
    }
}