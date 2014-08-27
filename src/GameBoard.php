<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Thruway\ClientSession;
use Thruway\Connection;

$onClose = function ($msg) {
    echo $msg;
};

$connection = new Connection([
    "realm" => $gameId,
    "onClose" => $onClose,
    "url" => 'ws://127.0.0.1:9090',
]);

$connection->on('open',
    function (ClientSession $session) {

        // 1) subscribe to a topic
        $onevent = function ($args) {
            echo "Event {$args[0]}\n";
        };
        $session->subscribe('com.myapp.hello', $onevent);

        // 2) publish an event
        $session->publish('com.myapp.hello', array('Hello, world from PHP!!!'), [], ["acknowledge" => true])->then(
            function () {
                echo "Publish Acknowledged!\n";
            },
            function ($error) {
                // publish failed
                echo "Publish Error {$error}\n";
            }
        );

        // 3) register a procedure for remoting
        $add2 = function ($args) {
            return $args[0] + $args[1];
        };
        $session->register('com.myapp.add2', $add2);
    }

);

$connection->open();
