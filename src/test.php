<?php


$mc = new MongoClient("mongodb://localhost");
$db = $mc->selectDB('mf');
$cards = new MongoCollection($db, 'cards');

foreach($cards->find() as $card){
	var_dump($card);
}


