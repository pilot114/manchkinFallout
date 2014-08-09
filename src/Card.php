<?php

namespace ManchkinFallout;

class Card
{
    public $id;
    public $types;
    public $action;

    public function __construct($id, $types, $action)
    {
        $this->id     = $id;
        $this->types  = $types;
        $this->action = $action;
    }

    public function play($player, $game)
    {
        $this->action($player, $game);
    }
}