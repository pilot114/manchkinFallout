<?php

// client code for Game Board

require dirname(__DIR__) . '/vendor/autoload.php';

use Thruway\ClientSession;
use Thruway\Connection;

$gameId = $argv[1];
$connection = new Connection([
    "realm"   => $gameId,
    "onClose" => function ($msg) { echo $msg; },
    "url"     => 'ws://127.0.0.1:9090',
]);

$connection->on('open',
    function (ClientSession $session) use ($gameId) {

        $session->subscribe('game.event', function ($args) use($session) {

        });
    }
);

$connection->open();