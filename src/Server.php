<?php

namespace ManchkinFallout;

use Thruway\Peer\Router;
use Thruway\Transport\RatchetTransportProvider;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/src/TestGame.php';

$router = new Router();
$transportProvider = new RatchetTransportProvider("127.0.0.1", 9090);

$router->addTransportProvider($transportProvider);
$router->start();