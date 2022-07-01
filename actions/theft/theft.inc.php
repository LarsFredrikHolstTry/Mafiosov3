<?php

include '../../global-variables.php';
include '../../functions/things.php';
include '../../db/PDODB.php';
include 'theftVariables.inc.php';

// TODO: Check if user has enough space for another car
// TODO: Check if user has cooldown on theft
// TODO: Give cooldown on succesfull theft

$legal = [0, 1, 2, 3];
$alt = $_POST['alt'];

if (!is_numeric($alt) || !in_array($alt, $legal)) {
    echo 'Ugyldig valg' . '<|>' . 'danger';
    return;
}

switch ($alt) {
    case 0:
        $thing_outcome = mt_rand(0, 7);
        break;
    case 1:
        $thing_outcome = mt_rand(8, 15);
        break;
    case 2:
        $thing_outcome = mt_rand(16, 23);
        break;
    case 3:
        $thing_outcome = mt_rand(24, 31);
        break;
}

DB::run("INSERT INTO storage (ST_acc_id, ST_type) VALUES (?,?)", [$session_id, $thing_outcome]);
DB::run("UPDATE cooldown SET CD_theft = " . time() + $cooldown[$alt] . "");

if (mt_rand(0, 100) < $chance[$alt]) {
    echo 'Du stjal ' . $thing_name[$thing_outcome] . ' til en verdi av ' . number($thing_price[$thing_outcome]) . ' kr! ' . '<|>' . 'success';
} else {
    echo 'Du feilet brekket!' . '<|>' . 'danger';
}
