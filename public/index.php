<?php

$route = $_SERVER['REQUEST_URI'];

if ($route == '/') {
    $gameId = uniqid();
} elseif($route == '/rule') {
    include 'rule.php';
    die();
} elseif(preg_match('#^/desk#',$route)) {
    include 'desk.php';
    die();
} else {
    include 'game.php';
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manchkin Fallout</title>
    <link rel="stylesheet" href="game.css"/>
</head>
<body id="main">
<div class="desc">
    <h1>Manchkin Fallout Online (alpha)</h1>
    <p>Онлайн версия игры.
        Автор оригинальной (настольной) игры -
        <a href="http://vk.com/leo_gonna_lie" target="_blank">Леонид Юскевич</a></p>
    <ul>
        <li><a href="/rule">Правила</a></li>
        <li><a href="/desk">Колода</a></li>
    </ul>
    <a href="/<?php echo $gameId; ?>"><button>Play</button></a>
</div>
</body>
</html>