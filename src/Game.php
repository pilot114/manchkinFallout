<?php

namespace ManchkinFallout;

//use Monolog\Logger;
//use Monolog\Handler\StreamHandl
//$stdout = new StreamHandler('php://stdout');
//$output = new Logger('Sock-Out');
//$input  = new Logger('Sock-In');
//$output->pushHandler($stdout);
//$input->pushHandler($stdout);

class Game
{
    public $players;
    public $desk;
    public $log;
    public $events;

    public function __construct()
    {
        $this->desk    = new Desk();
    }

    // вызов события. срабатывают все обработчики по очереди
    public function event($eventName, $args)
    {
        if(isset($this->events[$eventName])) {
            foreach($this->events[$eventName] as $func) {
                call_user_func_array($func, $args);
            }
        }
    }
    // добавить обработчик
    public function onEvent($eventName, \Closure $func)
    {
        $this->events[$eventName][] = $func;
    }


    public function startGame($playerCount = 3)
    {
        for($i = 1; $i <= $playerCount; $i++) {
            $startDoors      = $this->getCard('door', 4);
            $startPrizes     = $this->getCard('prize', 4);
            $startCards      = $startDoors + $startPrizes;
            $this->players[] = new Player($startCards, $gender = 1);
        }
    }
    public function isDay()
    {
        $hours = date('H');
        return $hours > 8 && $hours > 20;
    }
    public function sellRags($rags)
    {
    }
} 