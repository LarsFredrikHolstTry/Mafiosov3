<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/things.php';
include '../../functions/cars.php';

$cooldown = 60;

$legalFeedbackROS = ['specificPlayer', 'randomPlayer'];
$legalFeedbackCTM = ['car', 'thing', 'money'];

$randomOrSpecific = $_POST['randomOrSpecific'];
$carOrThingOrMoney = $_POST['carOrThingOrMoney'];
$player = $_POST['player'];
$player = strtolower($player);

$crime_cd = DB::run("SELECT CD_steal FROM cooldown WHERE CD_acc_id = $session_id")->fetchColumn();

if (!in_array($randomOrSpecific, $legalFeedbackROS) || !in_array($carOrThingOrMoney, $legalFeedbackCTM)) {
    echo 'Ugyldig valg' . '<|>' . 'danger';
    return;
}

if ($crime_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

if ($player != null) {
    $playerRow =    DB::run("SELECT ACC_id, ACC_username FROM account WHERE LOWER(ACC_username) = '" . strtolower($player) . "'")->fetch();
    if (!$playerRow) {
        echo 'Ugyldig spiller' . '<|>' . 'warning';
        return;
    }
} else {
    $playerRow =    DB::run("SELECT ACC_id, ACC_username FROM account WHERE NOT ACC_id = '" . $session_id . "'  ORDER BY RAND() LIMIT 1")->fetch();
}

if ($playerRow['ACC_id'] == $session_id) {
    echo 'Du kan ikke rane deg selv..' . '<|>' . 'warning';
    return;
}

if ($carOrThingOrMoney == 'car') {
    $carRow = DB::run("SELECT GA_id, GA_car FROM garage WHERE GA_acc_id = " . $playerRow['ACC_id'] . " ORDER BY RAND() LIMIT 1")->fetch();

    if ($carRow) {
        DB::run("UPDATE garage SET GA_acc_id = $session_id WHERE GA_acc_id = " . $playerRow['ACC_id']);
        echo 'Du stjal ' . $car_name[$carRow['GA_car']] . ' fra ' . $playerRow['ACC_username'] . '<|>' . 'success' . '<|>' . $cooldown;
    } else {
        echo $playerRow['ACC_username'] . ' har ingen biler i garasjen' . '<|>' . 'danger' . '<|>' . $cooldown;
    }
} elseif ($carOrThingOrMoney == 'thing') {
    $thingRow = DB::run("SELECT ST_id, ST_type FROM storage WHERE ST_acc_id = " . $playerRow['ACC_id'] . " ORDER BY RAND() LIMIT 1")->fetch();

    if ($thingRow) {
        DB::run("UPDATE storage SET ST_acc_id = $session_id WHERE ST_id = " . $thingRow['ST_id']);
        echo 'Du stjal ' . $thing_name[$thingRow['ST_type']] . ' fra ' . $playerRow['ACC_username'] . '<|>' . 'success' . '<|>' . $cooldown;
    } else {
        echo $playerRow['ACC_username'] . ' har ingen ting på lageret' . '<|>' . 'danger' . '<|>' . $cooldown;
    }
} elseif ($carOrThingOrMoney == 'money') {
    $moneyOnHand = DB::run("SELECT AS_money FROM account_stat WHERE AS_id = " . $playerRow['ACC_id'])->fetchColumn();

    $stealAmount = 0;

    if ($moneyOnHand > 0) {
        $stealAmount = mt_rand(1, $moneyOnHand);
    }

    if ($stealAmount > 0) {
        DB::run("UPDATE account_stat SET AS_money = AS_money + $stealAmount WHERE AS_id = " . $session_id);
        DB::run("UPDATE account_stat SET AS_money = AS_money - $stealAmount WHERE AS_id = " . $playerRow['ACC_id']);
        echo 'Du stjal ' . number($stealAmount) . ' kr fra ' . $playerRow['ACC_username'] . '' . '<|>' . 'success' . '<|>' . $cooldown;
    } else {
        echo $playerRow['ACC_username'] . ' har ingen penger på hånden' . '<|>' . 'danger' . '<|>' . $cooldown;
    }
}
DB::run("UPDATE cooldown SET CD_steal = " . time() + $cooldown . " WHERE CD_acc_id = " . $session_id);
