<?php

include '../../global-variables.php';
include '../../functions/things.php';
include '../../db/PDODB.php';

$total_thing_value = 0;
$total_things = 0;

$stmt = DB::run("SELECT ST_type from storage WHERE ST_acc_id = $session_id");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $total_thing_value = $total_thing_value + $thing_price[$row['ST_type']];
    $total_things++;
}


if ($total_things > 0) {
    DB::run("UPDATE account_stat SET AS_money = AS_money + $total_thing_value WHERE AS_id = $session_id");
    DB::run("DELETE FROM storage WHERE ST_acc_id = $session_id");

    echo 'Du solgte ' . number($total_things) . ' ting for ' . number($total_thing_value) . ' kr!' . '<|>' . 'success';
} else {
    echo 'Du har ingen ting å selge!' . '<|>' . 'danger';
}
