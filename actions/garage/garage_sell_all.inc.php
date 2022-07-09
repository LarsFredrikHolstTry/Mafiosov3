<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../db/PDODB.php';

$total_car_value = 0;
$total_cars = 0;

$stmt = DB::run("SELECT GA_car, GA_damage from garage WHERE GA_acc_id = $session_id");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $total_car_value = $total_car_value + ($car_price[$row['GA_car']] - ($row['GA_damage'] / 100) * $car_price[$row['GA_car']]);
    $total_cars++;
}

$plural_cars = $total_cars == 1 ? 'bil' : 'biler';

if ($total_cars > 0) {
    DB::run("UPDATE account_stat SET AS_money = AS_money + $total_car_value WHERE AS_id = $session_id");
    DB::run("DELETE FROM garage WHERE GA_acc_id = $session_id");

    echo 'Du solgte ' . number($total_cars) . ' ' . $plural_cars . ' for ' . number($total_car_value) . ' kr!' . '<|>' . 'success';
} else {
    echo 'Du har ingen biler å selge!' . '<|>' . 'danger';
}
