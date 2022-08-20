<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$familyMemberRow =  DB::run("SELECT FM_family_id, FM_role FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetch();
$familyId =         $familyMemberRow['FM_family_id'];
$familyRow =        DB::run("SELECT * FROM family WHERE FA_id = ?", [$familyMemberRow['FM_family_id']])->fetch();

# TODO: Check if in family

if ($familyMemberRow['FM_role'] == 2) {
    // Legg ned familie
    $warRow =        DB::run("SELECT * FROM family_war WHERE FW_family1 = $familyId OR FW_family2 = $familyId")->fetch();

    if ($warRow) {
        DB::run("DELETE FROM family_war WHERE FW_family1 = $familyId OR FW_family2 = $familyId");
    }

    DB::run("DELETE FROM family_application WHERE FAP_family = $familyId");
    DB::run("DELETE FROM family WHERE FA_id = $familyId");
    DB::run("DELETE FROM family_member WHERE FM_family_id = $familyId");

    echo 'Du la ned familien' . '<|>' . 'success';
} else {
    DB::run("DELETE FROM family_member WHERE FM_acc_id = $session_id");
}
