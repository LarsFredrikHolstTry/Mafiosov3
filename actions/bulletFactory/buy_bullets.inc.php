<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'bulletFactoryVariables.inc.php';

$value =    $_POST['value'];
$money =    DB::run("SELECT AS_money FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();
$bullets =  DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

if (!is_numeric($value) || $value <= 0) {
    echo 'Ugyldig input. Kun hele tall over 0 er tillatt.' . '<|>' . 'danger';
} elseif ($value * $price_pr_bullet > $money) {
    echo 'Du har ikke råd til ' . number($value) . ' kuler' . '<|>' . 'danger';
} elseif ($value && is_numeric($value) && $value + $bullets <= $max_bullets) {
    $total_price = $value * $price_pr_bullet;
    DB::run("UPDATE account_stat SET AS_money = AS_money - $total_price, AS_bullets = AS_bullets + $value WHERE AS_id = $session_id");
    echo 'Du kjøpte ' . number($value) . ' kuler for ' . number($total_price) . ' kr' . '<|>' . 'success';
} else {
    echo 'Du kan ikke ha mer enn 500 kuler totalt' . '<|>' . 'danger';
}
