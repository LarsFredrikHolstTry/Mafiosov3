<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../db/PDODB.php';

$carArr = $_POST['carArr'] ?? [];

$total_car_value = 0;
$total_cars = 0;

for ($i = 0; $i < count($carArr); $i++) {
    $stmt = DB::run("SELECT GA_car, GA_damage from garage WHERE GA_id = $carArr[$i] AND GA_acc_id = $session_id");
    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
        $total_car_value = $total_car_value + ($car_price[$row['GA_car']] - ($row['GA_damage'] / 100) * $car_price[$row['GA_car']]);
        $total_cars++;
        DB::run("DELETE FROM garage WHERE GA_id = $carArr[$i] AND GA_acc_id = $session_id");
    }
}

if ($total_cars > 0) {
    $carString = $total_cars > 1 ? 'biler' : 'bil';
    DB::run("UPDATE account_stat SET AS_money = AS_money + " . $total_car_value . " WHERE AS_id = " . $session_id . "");

    echo 'Du solgte ' . number($total_cars) . ' ' . $carString . ' for ' . number($total_car_value) . 'kr' . '<|>' . 'success';
} else {
    echo 'Du må velge minst 1 bil å selge' . '<|>' . 'warning';
}
