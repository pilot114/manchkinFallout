<?php

// game flow and log

namespace ManchkinFallout;

class Game
{
    public $players; // 3-6

    // pool and drop. drop to pool with suffle!!!
    public $doors;
    public $prizes;
    public $perks;

    public function __construct($playerCount) // 3-6
    {
        for($i=1; $i<=$playerCount; $i++) {
            $startDoors = array_slice($this->doors, -4, 4);
            $startPrizes = array_slice($this->prizes, -4, 4);
            $startCards = array_merge($startDoors, $startPrizes);
            $this->players[] = new Manchkin($startCards, $gender = 1);
        }
        
    }

    static public function random($max = 6)
    {
        return rand(1, $max);
    }
    static public function isDay(){
        $hours = date('H');
        return $hours > 8 && $hours > 20;
    }

    static public function sellRags($rags)
    {

    }
} 