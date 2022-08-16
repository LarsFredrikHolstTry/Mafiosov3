<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/cities.php';

$AS_city =      DB::run("SELECT AS_city FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();
$money_hand =   DB::run("SELECT AS_money FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();
$price = 15240;
$city_post = $_POST['city'];
$cooldown = 60;

$airport_cd =         DB::run("SELECT CD_travel FROM cooldown WHERE CD_acc_id = $session_id")->fetchColumn();

if ($airport_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

if ($price > $money_hand) {
    echo 'Du har ikke nok penger til å reise til  ' . $city[$city_post] . '<|>' . 'danger';
} elseif ($city_post == $AS_city) {
    echo 'Du er allerede i valgt by. ' . '<|>' . 'danger';
} else {
    $stmt = DB::run("UPDATE account_stat SET AS_city = ?, AS_money = AS_money - ? WHERE AS_id = ?", [$city_post, $price, $session_id]);
    $stmt->rowCount();
    DB::run("UPDATE cooldown SET CD_travel = " . time() + $cooldown . " WHERE CD_acc_id = " . $session_id);

    echo 'Du reiste til ' . $city[$city_post] . '<|>' . 'success' . '<|>' . $cooldown;
}
