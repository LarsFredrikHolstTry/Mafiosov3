<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../db/PDODB.php';
include 'carTheftVariables.inc.php';

// TODO: Check if user has enough space for another car

function hasMaxCars($user_id, $amountOfCars)
{
    $total_cars =           DB::run("SELECT count(*) FROM garage WHERE GA_acc_id = ?", [$user_id])->fetchColumn();
    $max_cars =             DB::run("SELECT US_max_cars FROM user_settings WHERE US_acc_id = ?", [$user_id])->fetchColumn();

    if ($amountOfCars + $total_cars > $max_cars) {
        return true;
    } else {
        return false;
    }
}

$session_city =     DB::run("SELECT AS_city FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();
$carTheft_cd =      DB::run("SELECT CD_carTheft FROM cooldown WHERE CD_acc_id = ?", [$session_id])->fetchColumn();

$legal = [0, 1, 2, 3, 4, 5];
$alt = $_POST['alt'];

if (!is_numeric($alt) || !in_array($alt, $legal)) {
    echo 'Ugyldig valg' . '<|>' . 'warning';
    return;
}

if ($carTheft_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

if (hasMaxCars($session_id, 1)) {
    echo 'Du har full garasje!' . '<|>' . 'warning';
    return;
}

switch ($alt) {
    case 0:
        $car_outcome = mt_rand(0, 9);
        break;
    case 1:
        $car_outcome = mt_rand(10, 19);
        break;
    case 2:
        $car_outcome = mt_rand(19, 29);
        break;
    case 3:
        $car_outcome = mt_rand(30, 39);
        break;
    case 4:
        $car_outcome = mt_rand(40, 49);
        break;
    case 5:
        $car_outcome = mt_rand(50, 59);
        break;
}

$damage = mt_rand(0, 99);

$car_price = ($car_price[$car_outcome] - ($damage / 100) * $car_price[$car_outcome]);

if (mt_rand(0, 100) < $chance[$alt]) {
    DB::run("INSERT INTO garage (GA_acc_id, GA_city, GA_car, GA_damage) VALUES (?,?,?,?)", [$session_id, $session_city, $car_outcome, $damage]);
    echo 'Du stjal en ' . $car_name[$car_outcome] . ' med ' . $damage . '% skadet til en verdi av ' . number($car_price) . ' kr! ' . '<|>' . 'success' . '<|>' . $cooldown[$alt];
} else {
    echo 'Du feilet biltyveriet!' . '<|>' . 'danger' . '<|>' . $cooldown[$alt];
}

DB::run("UPDATE cooldown SET CD_carTheft = " . time() + $cooldown[$alt] . " WHERE CD_acc_id = " . $session_id);
