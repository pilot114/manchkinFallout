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
            var_dump($realms);

            if(array_key_exists($gameId, $realms)){

                if(count($realms[$gameId]) > 2) {
                    echo "realm is full: {$gameId}\n";
                    $session->publish('realm.full', ['Game is full']);
                } else {
                    echo "Add new player in realm: {$gameId}\n";
                    if(!in_array($playerId, $realms[$gameId])) {
                        $realms[$gameId][] = $playerId;
                    }
                    $session->publish('realm.welcome', ['Welcome!']);
                }

            } else {
                // create realm ...
                echo "Create new realm with id: : {$gameId}\n";
                $realms[$gameId] = [];
                if(!in_array($playerId, $realms[$gameId])) {
                    $realms[$gameId][] = $playerId;
                }
                $session->publish('realm.welcome', ['Welcome!']);
            }
        });
    }
);

$connection->open();
