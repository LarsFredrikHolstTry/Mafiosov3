<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$money =        DB::run("SELECT AS_money FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();
$familyId =     DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetchColumn();

$moneyAmount = removeSpace($_POST['amount']);

if (!is_numeric($moneyAmount) || $moneyAmount < 0) {
    echo 'Ugyldig input. Kun hele tall over 0 er tillatt. ' . '<|>' . 'danger';
} elseif ($moneyAmount > $money) {
    echo 'Du kan ikke sette inn mer enn du har på hånden. ' . '<|>' . 'danger';
} else {
    DB::run("UPDATE account_stat SET AS_money = AS_money - ? WHERE AS_id = ?", [$moneyAmount, $session_id]);
    DB::run("UPDATE family SET FA_money = FA_money + ? WHERE FA_id = ?", [$moneyAmount, $familyId]);

    echo 'Du satt inn ' . number($moneyAmount) . ' kr i familiebanken!' . '<|>' . 'success';
}
