<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$value = removeSpace($_POST['value']);

$money_bank = DB::run("SELECT AS_bankmoney FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();
$money_hand = DB::run("SELECT AS_money FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

if (!is_numeric($value) || $value <= 0) {
    echo 'Ugyldig input. Kun hele tall over 0 er tillatt. ' . '<|>' . 'danger';
} elseif ($value && is_numeric($value) && $value <= $money_hand) {
    DB::run("UPDATE account_stat SET AS_money = AS_money - ?, AS_bankmoney = AS_bankmoney + ? WHERE AS_id = ?", [$value, $value, $session_id]);

    echo 'Du satt inn ' . number($value) . ' kr' . '<|>' . 'success';
} elseif ($value > $money_hand) {
    echo 'Du har ikke nok penger på hånden! ' . '<|>' . 'danger';
}
