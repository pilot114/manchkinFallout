<?php

// game->players
// game->prevPlayer
// game->nextPlayer
// game->onEvent('nameEvent', function(){})
// game->createMenu
// $player->addAbility('when', function(){})

// player : addCard     dropCard(num select mode), playCard(id)
// desk   : setCard     getCard(num select mode)

return [
    // classes
    0 => function($player, $game){
        $game->onEvent('soloBattleStart', function($player){
            $player->damage += 3;
        });
        $game->onEvent('soloBattleEnd', function($player){
            $player->damage -= 3;
        });
        $player->addAbility('exceptBattle', function($player, $game){
            $game->desk->setCard($player->dropCard(2, null, 'open'));
            $player->addCard($game->desk->getCard(1, 'door', 'dark'));
        });
    }, 0, 0, 0,
    4 => function($player, $game){
        $game->onEvent('assistBattleEnd', function($player, $game){
            $player->addCard($game->desk->getCard(1, 'prize', 'open'));
        });
        $player->damage += count($game->getActiveCard('paladin')) * 2;

        $game->onEvent('activatePaladin', function($player){
            $player->damage += 2;
        });
        $game->onEvent('deactivatePaladin', function($player){
            $player->damage -= 2;
        });
    }, 4, 4, 4,
    8 => function($player, $game){
        $player->addAbility('anytime', function($player, $game){
            $game->desk->setCard($player->dropCard(3, null, 'open'));
            $player->addCard($game->selectAnyHandCardOrActiveRags());
        });
        $player->marauderRags += 1;
    }, 8, 8, 8,
    12 => function($player, $game){
        $player->escapePoint += 1;
        $game->addAbility('trapTime', function($player, $game){
            $player->dropCard(3, null, 'open');
            $game->selectTrapTarget();
        });
    }, 12, 12, 12,
    16 => function($player, $game){
        $player->dropCard(1, 'helmet');
    },
    17 => function($player, $game){
        $game->onEvent('nearEscapeStart', function($player){
            $player->$escape -= 100;
        });
        $game->onEvent('nearEscapeEnd', function($player){
            $player->$escape += 100;
        });
    },




    function($player, $game){},
];