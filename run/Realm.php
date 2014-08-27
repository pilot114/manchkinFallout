<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Thruway\ClientSession;
use Thruway\Connection;

$onClose = function ($msg) {
    echo $msg;
};

$connection = new Connection([
    "realm"   => 'realm',
    "onClose" => $onClose,
    "url"     => 'ws://127.0.0.1:9090',
]);

$connection->on('open',
    function (ClientSession $session) {

        $session->subscribe('realm.create', function ($args) {
            // check has realm ..
            echo "Create new realm with id: : {$args[0]}\n";
            // create realm ...
            // or return error...
        });

//        $session->publish('com.myapp.hello', ['Hello, world from PHP!!!'], [], ["acknowledge" => true])
//            ->then(
//                function () {
//                    echo "Publish Acknowledged!\n";
//                },
//                function ($error) {
//                    echo "Publish Error {$error}\n";
//                }
//            );
    }
);

$connection->open();
