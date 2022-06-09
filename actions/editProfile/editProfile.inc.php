<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$value = $_POST['value'];

$profile_text =  DB::run("SELECT PR_content FROM profiles WHERE PR_acc_id = ?", [$session_id])->fetchColumn();

if ($profile_text) {
    DB::run("UPDATE profiles SET PR_content = ? WHERE PR_acc_id = ?", [$value, $session_id]);
} else {
    DB::run("INSERT INTO profiles (PR_content, PR_acc_id) VALUES (?,?)", [$value, $session_id]);
}

echo 'Profilen ble oppdatert!' . '<|>' . 'success';
