<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'fightClubVariables.inc.php';

$legal = [0, 1, 2];
$alt = $_POST['alt'];

$fc_training_cd = DB::run("SELECT CD_fc_training FROM cooldown WHERE CD_acc_id = $session_id")->fetchColumn();

if ($fc_training_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

if (!is_numeric($alt) || !in_array($alt, $legal)) {
    echo 'Ugyldig valg' . '<|>' . 'warning';
    return;
}

$addPointsAmount = $addon[$alt];

DB::run("UPDATE account_stat SET AS_fightpoints = AS_fightpoints + $addPointsAmount WHERE AS_id = $session_id");
DB::run("UPDATE cooldown SET CD_fc_training = " . time() + $cooldown[$alt] . " WHERE CD_acc_id = " . $session_id);

echo 'Du trente deg i ' . $category[$alt] . ' og fikk ' . $addPointsAmount . ' styrkepoeng!' . '<|>' . 'success' . '<|>' . $cooldown[$alt];
