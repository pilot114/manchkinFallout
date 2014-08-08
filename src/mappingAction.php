<?php

// game->players
// game->prevPlayer
// game->nextPlayer
// game->onEvent('nameEvent', function(){})
// game->createMenu
// $player->addAbility('when', function(){})

// action if card has is active

return [
    function() use($player, $game){
        $game->event('soloBattleStart', function($player){
            $player->modDamage(3);
        });
        $game->event('soloBattleEnd', function($player){
            $player->modDamage(-3);
        });
        $player->addAbility('exceptBattle', function() use ($player){
            $player->modCard(-2, true); // with menu
            $player->modCard(1, 'door', 'dark');
        });
    },
    null, null, null,
    function() use($player, $game){
        $game->event('assistBattleEnd', function($player){
            $player->modCard(1, 'prize');
        });
        $player->addAbility('exceptBattle', function() use ($player){
            $player->modCard(1, 'door', 'dark');
        });
    },



    function() use($player, $game){},
];