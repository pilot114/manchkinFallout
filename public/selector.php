<?php

include "../src/Desk.php";

$desk = new \ManchkinFallout\Desk();
$test = $desk->getSimple();

foreach($test as $id => $card) {
    foreach($card['types'] as $type){
        $types[$type] = null;
    }
}

echo "<form>";
echo "<select name='selector'>";
foreach($types as $type => $nothing) {
    if(isset($_GET['selector']) && $_GET['selector'] == $type) {
        echo "<option selected>$type</option>";
    } else {
        echo "<option>$type</option>";
    }
}
echo '</select>';
echo '<input type="submit" value="Send">';
echo '</form>';

$count = 0;
$result = null;
if(!empty($_GET)) {
    foreach($test as $id => $card) {
        if(in_array($_GET['selector'], $card['types'])) {
            $count ++;
            echo $id . ' ';
            $result .= "<img src='/card/mini/$id.png' width='160'>";
        }
    }
} else {
    foreach($test as $id => $card) {
        $count ++;
        $result .= "<img src='/card/mini/$id.png' width='160'>";
    }
}
echo '<h2>' . $count . '</h2>';
echo $result;
