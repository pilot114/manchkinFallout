<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Thruway\ClientSession;
use Thruway\Connection;

$connection = new Connection([
    "realm"   => 'realm',
    "onClose" => function ($msg) { echo $msg; },
    "url"     => 'ws://127.0.0.1:9090',
]);

$connection->on('open',
    function (ClientSession $session) {
        $session->subscribe('realm.init', function ($args) use($session) {

            static $realms = [];
            $gameId   = $args[0];
            $playerId = $args[1];

            if(array_key_exists($gameId, $realms)){

                if(!in_array($playerId, $realms[$gameId])) {
                    echo "Add new player '$playerId' in realm: $gameId\n";
                    $realms[$gameId][] = $playerId;
                    if(count($realms[$gameId]) > 2) {
                        echo "realm '$gameId' is full \n";
                        echo "List player: \n";
                        var_dump($realms[$gameId]);
                        $session->publish('realm.full', ['Game is full']);
                    }
                }
                $session->publish('realm.welcome', ['Welcome!']);

            } else {
                // create and run gameBoard...
                system("php GameBoard.php $gameId > /dev/null &", $info);

                $realms[$gameId] = [];
                echo "Create new realm with id: : $gameId\n";
                $realms[$gameId][] = $playerId;
                echo "Master this realm: $playerId\n";

                $session->publish('realm.welcome', ['Welcome!']);
            }
        });
    }
);


$connection->open();
