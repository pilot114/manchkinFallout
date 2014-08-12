<?php

namespace ManchkinFallout;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/src/TestGame.php';

$stdout = new StreamHandler('php://stdout');
$logout = new Logger('SockOut');
$login  = new Logger('Sock-In');
$login->pushHandler($stdout);
$logout->pushHandler($stdout);

//$server = IoServer::factory(
//    new HttpServer(
//        new WsServer(
//            new TestGame()
//        )
//    ),
//    9090
//);

$server = new \Ratchet\App('127.0.0.1', 9090);
$server->route('/realm', new TestGame());
$server->run();
