<?php

//include '../vendor/autoload.php';
$cards = include '../src/mapping.php';

$number = 231;

var_dump($cards[$number]);

echo '<img src="card/mini/' . $number . '.png" width="250">';
