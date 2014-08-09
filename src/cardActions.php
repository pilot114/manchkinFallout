<?php

// game->players
// game->prevPlayer
// game->nextPlayer
// game->onEvent('nameEvent', function(){})
// game->createMenu
// $player->addAbility('when', function(){})

// player : addCard     dropCard(num select mode), playCard(id)
// deck   : setCard     getCard(num select mode)

return [
    // classes
    0 => function($player, $game){
        $game->onEvent('soloBattleStart', function($player){
            $player->modDamage(3);
        });
        $game->onEvent('soloBattleEnd', function($player){
            $player->modDamage(-3);
        });
        $player->addAbility('exceptBattle', function($player, $game){
            $game->desk->setCard($player->dropCard(-2, null, true));
            $player->addCard($game->desk->getCard(1, 'door', true));
        });
    },
    0, 0, 0,
    4 => function($player, $game){
        $game->onEvent('assistBattleEnd', function($player){
            $player->modCard(1, 'prize');
        });
        $player->addAbility('exceptBattle', function($player){
            $player->modCard(1, 'door', 'dark');
        });
    },



    function($player, $game){},
];