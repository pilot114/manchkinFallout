<?php

namespace ManchkinFallout;

$loader = require '../vendor/autoload.php';

$game = new Game(3);

foreach($game->players as $player) {

    foreach($player->handCard as $cardId => $card) {
        echo '<img src="card/mini/' . $cardId . '.png" width="120">';
    }
    echo '<br>';
}
