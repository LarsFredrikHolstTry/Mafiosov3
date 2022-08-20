<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$familyId = $_POST['familyId'];
$applicationText = $_POST['applicationText'];

$isMember =             DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetchColumn();
$alreadyApplicated =    DB::run("SELECT FAP_id FROM family_application WHERE FAP_acc_id = ? AND FAP_family = ?", [$session_id, $familyId])->fetchColumn();

if ($isMember) {
    echo 'Du er allerede med i en familie' . '<|>' . 'warning';
    return;
}

if ($alreadyApplicated) {
    echo 'Du har allerede en aktiv søknad til familien' . '<|>' . 'warning';
    return;
}

echo 'Du har sendt en familiesøknad' . '<|>' . 'success';
DB::run("INSERT INTO family_application (FAP_text, FAP_family, FAP_acc_id, PM_date) VALUES (?,?,?,?)", [$applicationText, $familyId, $session_id, time()]);
