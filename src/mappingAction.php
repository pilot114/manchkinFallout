<?php

// game->players
// game->prevPlayer
// game->nextPlayer
// game->onEvent('nameEvent', function(){})
// game->createMenu
// $user->addAbility('when', function(){})

// action if card has is active

return [
    0 => function() use($user, $game){
        $game->event('soloBattleStart', function($user){
            $user->modDamage(3);
        });
        $game->event('soloBattleEnd', function($user){
            $user->modDamage(-3);
        });
        $user->addAbility('exceptBattle', function() use ($user){
            $user->modCard(-2, true); // with menu
            $user->modCard(1, 'door', 'dark');
        });
    },
    function($args) use($user, $game){},
];