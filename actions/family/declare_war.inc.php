<?php
include '../../functions/cities.php';
include '../../global-variables.php';
include '../../db/PDODB.php';

$familyAttack =         $_POST['family'];
$familyId =             DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetchColumn();

if (!is_numeric($familyAttack) || $familyAttack < 0 || $familyAttack == $familyId) {
    echo 'Ugyldig familiy' . '<|>' . 'danger';
    return;
}

$familyRow =            DB::run("SELECT FA_war FROM family WHERE FA_id = ?", [$familyId])->fetch();
$familyContestantRow =  DB::run("SELECT FA_war, FA_name FROM family WHERE FA_id = ?", [$familyAttack])->fetch();

if ($familyRow['FA_war'] != 0) {
    echo 'Din familie er allerede i en aktiv krig!' . '<|>' . 'danger';
} elseif ($familyContestantRow['FA_war'] != 0) {
    echo 'Familien du prøver å angripe er allerede i en aktiv krig!' . '<|>' . 'danger';
} else {
    $uniqueWarId = uniqid();
    DB::prepare("INSERT INTO family_war (FW_warId, FW_family1, FW_family2, FW_date) VALUES (?,?,?,?)")->execute([$uniqueWarId, $familyId, $familyAttack, time()]);

    $action = 'erklærte krig mot ' . $familyContestantRow['FA_name'];
    DB::prepare("INSERT INTO family_war_activity (FWA_warId, FWA_family, FWA_account_id, FWA_action, FWA_date) VALUES (?,?,?,?,?)")->execute([$uniqueWarId, $familyId, $session_id, $action, time()]);

    DB::run("UPDATE family SET FA_war = ? WHERE FA_id = ?", [$familyAttack, $familyId]);
    DB::run("UPDATE family SET FA_war = ? WHERE FA_id = ?", [$familyId, $familyAttack]);

    echo 'Dere har angrepet ' . $familyContestantRow['FA_name'] . ' og er nå i en aktiv krig mot familien!' . '<|>' . 'success';
}
