<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'familyvariables.inc.php';

$money = DB::run("SELECT AS_money FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

$familyName = $_POST['name'];
$minChars = 3;
$maxChars = 15;
$familyNameExist = DB::run("SELECT * FROM family WHERE FA_name = ?", [$familyName])->fetchColumn();

if (strlen($familyName) < $minChars || strlen($familyName) > $maxChars) {
    echo 'Familienavnet kan ikke være kortere enn ' . $minChars . ' karakterer eller lengre enn ' . $maxChars . ' ' . '<|>' . 'danger';
} elseif ($createFamilyPrice > $money) {
    echo 'Du har ikke nok penger til å stifte familie ' . '<|>' . 'danger';
} elseif ($familyNameExist) {
    echo 'Familienavnet er ikke ledig ' . '<|>' . 'danger';
} else {
    if (preg_match('/[A-Za-z]/', $familyName) || preg_match('/[0-9]/', $familyName)) {
        DB::run("UPDATE account_stat SET AS_money = AS_money - " . $createFamilyPrice . " WHERE AS_id = " . $session_id);
        DB::run("INSERT INTO family (FA_name, FA_created) VALUES (?,?)", [$familyName, time()]);
        $familyId = DB::lastInsertId();
        DB::run("INSERT INTO family_member (FM_acc_id, FM_family_id, FM_role, FM_joined) VALUES (?,?,?,?)", [$session_id, $familyId, 2, time()]);

        echo 'Du stiftet familien ' . $familyName . '<|>' . 'success';
    } else {
        echo 'Familienavnet kan ikke kun bestå av mellomrom ' . '<|>' . 'danger';
    }
}
