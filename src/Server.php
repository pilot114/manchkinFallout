<?php

namespace ManchkinFallout;

use Ratchet\Server\IoServer;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Wamp\WampServer;
use Monolog

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new TestGame()
        )
    ),
    9090
);

$server->run();



use Ratchet\Tutorials\Chat;
use Ratchet\Cookbook\MessageLogger;
use Monolog\Logger;

require dirname(__DIR__) . '/vendor/autoload.php';

$stdout = new \Monolog\Handler\StreamHandler('php://stdout');
$logout = new Logger('SockOut');
$login  = new Logger('Sock-In');
$login->pushHandler($stdout);
$logout->pushHandler($stdout);

$server = IoServer::factory(
    new MessageLogger(
        new Chat()
        , $login
        , $logout
    )
    , 8080
);

$server->run();
