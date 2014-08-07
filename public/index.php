<?php

//include '../vendor/autoload.php';
$cards = include '../src/mapping.php';

$number = rand(0,279);

var_dump($cards[$number]);

echo $number;
echo '<br><img src="card/mini/' . $number . '.png" width="250">';
