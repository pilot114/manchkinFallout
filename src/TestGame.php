<?php

namespace ManchkinFallout;

use Ratchet\ConnectionInterface as Conn;
use Ratchet\Wamp\WampServerInterface;
use Ratchet\MessageComponentInterface;

class TestGame implements WampServerInterface, MessageComponentInterface
{
    public function onSubscribe(Conn $conn, $topic) {
        echo 'sub';
    }
    public function onUnSubscribe(Conn $conn, $topic) {
        echo 'unsub';
    }

    public function onPublish(Conn $conn, $topic, $event, array $exclude, array $eligible) {
        $topic->broadcast($event);
    }

    public function onCall(Conn $conn, $id, $topic, array $params) {
        $conn->callResult($id, $topic, 'Test RPC result');
    }



    public function onOpen(Conn $conn)
    {
        echo 'open';
        $conn->send('You is connect!');
    }

    public function onClose(Conn $conn)
    {
        echo 'close';
    }

    public function onError(Conn $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }


    public function onMessage(Conn $from, $msg)
    {
        echo $msg;
    }
}