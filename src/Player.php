<?php

namespace ManchkinFallout;

class Player extends \SplObjectStorage
{
    public $resourceId;
    public $level;
    public $class;
    public $gender;
    public $damage;
    public $marauderRags;
    public $escapePoint;
    public $antiradPoint;

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
        $this->marauderRags = 1;
        $this->escapePoint = 1;
        $this->antiradPoint = 1;
        $this->gender = $gender;
        $this->handCard = $startCards;
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

    public function dropCard($count, $selector, $mode = 'dark')
    {
        if ($mode == 'dark') {
            return $this->activeCard;
        } else {
            return $this->activeCard;
        }
    }
}