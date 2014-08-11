<?php

$card = include 'cardTypes.php';
$cardM = include 'monsterData.php';
$cardR = include 'ragsData.php';
$cardW = include 'weaponData.php';
$cardC = include 'closingData.php';

foreach($card as $key => $types){
$transform[$key]['key'] = $key;
$transform[$key]['types'] = $types;
if(isset($cardM[$key])){
	$transform[$key]['monster'] = [];
	$transform[$key]['monster']['level'] = $cardM[$key][0];
	$transform[$key]['monster']['radiation'] = $cardM[$key][1];
	$transform[$key]['monster']['prize'] = $cardM[$key][2];
	$transform[$key]['monster']['up'] = $cardM[$key][3];
}
if(isset($cardR[$key])){
	$transform[$key]['rags'] = [];
	$transform[$key]['rags']['price'] = $cardR[$key];
}
if(isset($cardW[$key])){
	$transform[$key]['weapon'] = [];
	$transform[$key]['weapon']['hand'] = $cardW[$key][0];
	$transform[$key]['weapon']['damage'] = $cardW[$key][1];
	$transform[$key]['weapon']['kind'] = $cardW[$key][2];
}
if(isset($cardC[$key])){
	$transform[$key]['closing'] = [];
	$transform[$key]['closing']['shield'] = $cardC[$key][0];
	$transform[$key]['closing']['kind'] = $cardC[$key][1];
}
}


$mc = new MongoClient("mongodb://localhost");
$db = $mc->selectDB('mf');
$cards = new MongoCollection($db, 'cards');
//$cards->drop();

//foreach($transform as $card){
//	$cards->insert($card);
//}

foreach($cards->find() as $card) {
	var_dump($card);
}


