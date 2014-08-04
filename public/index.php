<?php

include '../vendor/autoload.php';
$cards = include '../src/mapping.php';

$number = 20;

var_dump($cards[$number]);

echo '<img src="card/result/' . $number . '.png" width="250">';

foreach (glob("card/result/0*.png") as $filename) {
    $filename = basename($filename);
    $files[] = $filename;
}
echo count($files);
