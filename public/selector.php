<?php

$cards = include '../src/cardTypes.php';

$test = [];
foreach($cards as $id => $types) {
    foreach($types as $type) {
        $test[$type] = null;
    }
}

echo "<form>\n";
echo "<select name='selector'>";
foreach($test as $k => $v) {
    if(isset($_GET['selector']) && $_GET['selector'] == $k) {
        echo "<option selected>$k</option>";
    } else {
        echo "<option>$k</option>";
    }
}
echo '</select>';
echo '<input type="submit" value="Отправить">';
echo '</form>';

$count = 0;
$result = null;
if(!empty($_GET)) {
    foreach($cards as $id => $types) {
        if(in_array($_GET['selector'], $types)) {
            $count ++;
            echo $id . ' ';
            $result .= "<img src='/card/mini/$id.png' width='160'>";
        }
    }
} else {
    foreach($cards as $id => $types) {
        $count ++;
        $result .= "<img src='/card/mini/$id.png' width='160'>";
    }
}

echo '<h2>' . $count . '</h2>';
echo $result;
