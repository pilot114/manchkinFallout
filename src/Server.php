<?php

namespace ManchkinFallout;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/src/TestGame.php';

$stdout = new StreamHandler('php://stdout');
$logout = new Logger('SockOut');
$login  = new Logger('Sock-In');
$login->pushHandler($stdout);
$logout->pushHandler($stdout);


$server = new \Ratchet\App('localhost', 9090);
$server->route('/wsapi', new TestGame());
$server->run();
