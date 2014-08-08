<?php

namespace ManchkinFallout;

class Game
{
    public $players;
    public $desk;

    public function __construct($playerCount = 3)
    {
        $cards = include('mapping.php');
        $this->shuffleAssoc($cards);
        $this->desk['pool'] = $cards;

        for($i=1; $i<=$playerCount; $i++) {
            $startDoors = $this->getCard('door', 4);
            $startPrizes = $this->getCard('prize', 4);
            $startCards = $startDoors + $startPrizes;
            $this->players[] = new Manchkin($startCards, $gender = 1);
        }
    }

    public function getCard($selector, $count)
    {
        $cards = [];
        foreach($this->desk['pool'] as $cardId => $types) {
            if (in_array($selector, $types)) {
                $cards[$cardId] = $types;
                unset($this->desk['pool'][$cardId]);
                if(count($cards) == $count) break;
            }
        }
        return $cards;
    }

    public function dropCard($cards)
    {
        foreach($cards as $cardId => $types) {
            if(in_array('door', $types)) {
                $this->doors['drop'][$cardId] = $types;
            } elseif (in_array('perk', $types)) {
                $this->perks['drop'][$cardId] = $types;
            } else {
                $this->prizes['drop'][$cardId] = $types;
            }
        }
    }

    public function shuffleAssoc(&$array) {
        $keys = array_keys($array);
        shuffle($keys);
        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }
        $array = $new;
        return true;
    }

    public function isDay()
    {
        $hours = date('H');
        return $hours > 8 && $hours > 20;
    }

    public function dropToPool($place)
    {
        $this->shuffleAssoc($this->$place['drop']);
        $this->$place['pool'] = $this->$place['drop'];
        $this->$place['drop'] = [];
    }

    public function sellRags($rags)
    {

    }
} 