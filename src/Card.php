<?php

namespace ManchkinFallout\Card;

class Card
{
    public $id;
    public $types;

    public function __construct($id, $types)
    {
        $this->id    = $id;
        $this->types = $types;
    }

    public function play()
    {


    }
}