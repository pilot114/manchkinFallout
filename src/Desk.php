<?php

namespace ManchkinFallout;

class Desk
{
    private $ids;
    private $cardData;
    private $cardActions;

    public function __construct()
    {
        $mc = new \MongoClient("mongodb://localhost");
        $db = $mc->selectDB('mf');
        $cards = new \MongoCollection($db, 'cards');
        foreach($cards->find() as $card) {
            unset($card['_id']);
            $this->cardData[] = $card;
        }
        shuffle($ids = range(0, 279));
        foreach($ids as $id) {
            $this->ids['pool'][$id] = null;
        }
    }

    public function getSimple()
    {
        return $this->cardData;
    }

    public function getCard($count, $selector, $mode = 'open')
    {
        $cards = [];
        foreach($this->ids['pool'] as $id => $nothing) {
            if (in_array($selector, $this->cardTypes[$id])) {
                $cards[] = new Card($id, $this->cardTypes[$id], $this->cardActions[$id]);
                unset($this->ids['pool'][$id]);
                if (count($cards) == $count) break;
            }
        }
        if(empty($cards) && ($selector == 'door' || $selector == 'prize')) {
            $this->refresh($selector);
            $cards = $this->getCard($count, $selector);
        }
        return $cards;
    }

    public function setCard($cards)
    {
        foreach($cards as $card) {
            $this->ids['drop'][$card->id] = null;
            unset($card);
        }
    }

    public function refresh($selector)
    {
        foreach($this->ids['drop'] as $id => $nothing) {
            if (in_array($selector, $this->cardTypes[$id])) {
                $this->ids['pool'][$id] = null;
                unset($this->ids['drop'][$id]);
            }
        }
        $shuffleIds = array_keys($this->ids['pool']);
        shuffle($shuffleIds);
        foreach($shuffleIds as $id) {
            $this->ids['pool'][$id] = null;
        }
    }
}
