<?php

//  128 + 132 + 20 = 280

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

    public function discard()
    {

    }
} 