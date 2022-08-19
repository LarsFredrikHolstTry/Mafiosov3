<?php

include '../../global-variables.php';
include '../../functions/things.php';
include '../../db/PDODB.php';

$thingArr = $_POST['thingArr'] ?? [];

$total_thing_value = 0;
$total_things = 0;

for ($i = 0; $i < count($thingArr); $i++) {
    $stmt = DB::run("SELECT ST_type from storage WHERE ST_id = $thingArr[$i] AND ST_acc_id = $session_id");
    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
        $total_thing_value = $total_thing_value + $thing_price[$row['ST_type']];
        $total_things++;
        DB::run("DELETE FROM storage WHERE ST_id = $thingArr[$i] AND ST_acc_id = $session_id");
    }
}

if ($total_things > 0) {
    DB::run("UPDATE account_stat SET AS_money = AS_money + " . $total_thing_value . " WHERE AS_id = " . $session_id . "");

    echo 'Du solgte ' . number($total_things) . ' ting for ' . number($total_thing_value) . 'kr' . '<|>' . 'success';
} else {
    echo 'Du må velge minst 1 ting å selge' . '<|>' . 'warning';
}
