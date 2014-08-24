<?php

// master
if ($_SERVER['REQUEST_URI'] == '/') {
    $gameId = uniqid();
} else { // slave
    include 'game.php';
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manchkin Fallout</title>
    <link rel="stylesheet" href="game.css"/>
    <script src="jquery.min.js"></script>
    <script src="autobahn.min.js"></script>
    <script src="game.js"></script>
</head>
<body id="main">
<div class="desc">
    <h1>Manchkin Fallout Online (alpha)</h1>
    <p>Онлайн версия игры.
        Автор оригинальной (настольной) игры -
        <a href="http://vk.com/leo_gonna_lie" target="_blank">Леонид Юскевич</a></p>
    <a href="/<?php echo $gameId; ?>"><button>Play</button></a>
</div>
</body>
</html>