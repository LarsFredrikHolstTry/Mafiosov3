<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$bullets =              DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();
$familyId =             DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetchColumn();
$familyBullets =        DB::run("SELECT FA_bullets FROM family WHERE FA_id = ?", [$familyId])->fetchColumn();

$bulletsAmount = removeSpace($_POST['amount']);

if (!is_numeric($bulletsAmount) || $bulletsAmount < 0) {
    echo 'Ugyldig input. Kun hele tall over 0 er tillatt. ' . '<|>' . 'danger';
} elseif ($bulletsAmount > $familyBullets) {
    echo 'Du kan ikke ta ut fler kuler enn det er i familien. ' . '<|>' . 'danger';
} else {
    DB::run("UPDATE account_stat SET AS_bullets = AS_bullets + ? WHERE AS_id = ?", [$bulletsAmount, $session_id]);
    DB::run("UPDATE family SET FA_bullets = FA_bullets - ? WHERE FA_id = ?", [$bulletsAmount, $familyId]);

    echo 'Du satt inn ' . number($bulletsAmount) . ' kuler i familien!' . '<|>' . 'success';
}
