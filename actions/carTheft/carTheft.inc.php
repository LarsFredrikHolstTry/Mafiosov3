<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../db/PDODB.php';
include 'carTheftVariables.inc.php';

// TODO: Check if user has enough space for another car
// TODO: Check if user has cooldown on carTheft
// TODO: Give cooldown on succesfull cartheft

$session_city = DB::run("SELECT AS_city FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

$legal = [0, 1, 2, 3, 4, 5];
$alt = $_POST['alt'];

if (!is_numeric($alt) || !in_array($alt, $legal)) {
    echo 'Ugyldig valg' . '<|>' . 'danger';
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

DB::run("INSERT INTO garage (GA_acc_id, GA_city, GA_car) VALUES (?,?,?)", [$session_id, $session_city, $car_outcome]);
DB::run("UPDATE cooldown SET CD_carTheft = " . time() + $cooldown[$alt] . "");

if (mt_rand(0, 100) < $chance[$alt]) {
    echo 'Du stjal en ' . $car_name[$car_outcome] . ' til en verdi av ' . number($car_price[$car_outcome]) . ' kr! ' . '<|>' . 'success';
} else {
    echo 'Du feilet biltyveriet!' . '<|>' . 'danger';
}
