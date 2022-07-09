<?php

include '../../global-variables.php';
include 'crimeVariables.inc.php';

$legal = [0, 1, 2, 3, 4, 5];
$alt = $_POST['alt'];
$crime_cd = DB::run("SELECT CD_crime FROM cooldown WHERE CD_acc_id = ?", [$session_id])->fetchColumn();
$bullets = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

if (!is_numeric($alt) || !in_array($alt, $legal)) {
    echo 'Ugyldig valg!' . '<|>' . 'warning';
    return;
}

if ($crime_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

DB::run("UPDATE cooldown SET CD_crime = " . time() + $cooldown[$alt] . " WHERE CD_acc_id = " . $session_id);
if (mt_rand(0, 100) < $chance[$alt]) {
    $bullets_used = $bullets > 10 ? mt_rand(0, 10) : mt_rand(0, $bullets);
    $money = mt_rand($payout_from[$alt], $payout_to[$alt]);
    DB::run("UPDATE account_stat SET AS_bullets = AS_bullets - " . $bullets_used . ", AS_money = AS_money + " . $money . ", AS_exp = AS_exp + " . $exp[$alt] . " WHERE AS_id = " . $session_id . "");

    echo 'Du stjal ' . number($money) . ' kr! På vei fra åstedet måtte du bruke ' . number($bullets_used) . ' kuler ' . '<|>' . 'success' . '<|>' . $cooldown[$alt];
} else {
    echo 'Du feilet kriminaliteten!' . '<|>' . 'danger' . '<|>' . $cooldown[$alt];
}
