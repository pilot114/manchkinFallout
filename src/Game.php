<?php

namespace ManchkinFallout;

use Ratchet\ConnectionInterface as Conn;
use Ratchet\Wamp\WampServerInterface as WSI;
use Ratchet\MessageComponentInterface as MCI;

class Game implements WSI, MCI
{
    public $players;
    public $desk;
    public $log;

    public function __construct()
    {
        $cards = include('mapping.php');
        $this->shuffleAssoc($cards);
        $this->desk['pool'] = $cards;
        $this->players      = new \SplObjectStorage;
    }

    // Подписка/отписка на $topic
    public function onSubscribe(Conn $conn, $topic) {}
    public function onUnSubscribe(Conn $conn, $topic) {}

    public function onPublish(Conn $conn, $topic, $event, array $exclude, array $eligible) {
        echo 'publish';
        $topic->broadcast($event);
    }

    // экшен
    public function onCall(Conn $conn, $id, $topic, array $params) {
        echo 'call action';
        $conn->callResult($id, $topic, 'Test RPC result');
    }

    
    // новый клент
    public function onOpen(Conn $conn)
    {
        echo 'new connect!';
        $this->players->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
        if (count($this->players) == 1) {
            echo 'Generate game id..';
            echo uniqid();
        }
        if (count($this->players) > 2) {
            echo 'Ready...';
        }
    }

    // клент отвалился
    public function onClose(Conn $conn)
    {
        $this->players->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }
    public function onError(Conn $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onMessage(Conn $from, $msg)
    {
        $numRecv = count($this->players) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        foreach($this->players as $player) {
            if ($from !== $player) {
                $player->send($msg);
            }
        }
    }





    public function startGame($playerCount = 3)
    {
        for($i = 1; $i <= $playerCount; $i++) {
            $startDoors      = $this->getCard('door', 4);
            $startPrizes     = $this->getCard('prize', 4);
            $startCards      = $startDoors + $startPrizes;
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
                if (count($cards) == $count) break;
            }
        }
        return $cards;
    }

    public function dropCard($cards)
    {
        $this->desk['drop'] = $cards;
    }

    public function refreshPool($place)
    {
        $this->shuffleAssoc($this->$place['drop']);
        $this->$place['pool'] = $this->$place['drop'];
        $this->$place['drop'] = [];
    }

    public function shuffleAssoc(&$array)
    {
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

    public function sellRags($rags)
    {

    }
} 