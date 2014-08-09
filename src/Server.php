<?php

namespace ManchkinFallout;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = new \Ratchet\App('localhost');
$server->route('/game', new Game());
$server->run();
