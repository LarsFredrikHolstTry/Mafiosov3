<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'fightClubVariables.inc.php';

$fc_fight_cd =          DB::run("SELECT CD_fc_fight FROM cooldown WHERE CD_acc_id = $session_id")->fetchColumn();
$Contestant =           DB::run("SELECT ACC_id, ACC_username FROM account WHERE NOT ACC_id = '" . $session_id . "'  ORDER BY RAND() LIMIT 1")->fetch();
$score =                DB::run("SELECT AS_fightpoints FROM account_stat WHERE AS_id = $session_id")->fetch();
$scoreContestant =      DB::run("SELECT AS_fightpoints FROM account_stat WHERE AS_id = '" . $Contestant['ACC_id'] . "'")->fetch();

$cooldown = 7;

if ($fc_fight_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

if ($score > $scoreContestant) {
    DB::prepare("INSERT INTO fc_fights (FC_loser, FC_winner, FC_date) VALUES (?,?,?)")->execute([$Contestant['ACC_id'], $session_id, time()]);
    DB::run("UPDATE cooldown SET CD_fc_fight = " . time() + $cooldown . " WHERE CD_acc_id = " . $session_id);

    echo 'Du slåss mot ' . $Contestant['ACC_username'] . ' og vant!' . '<|>' . 'success' . '<|>' . $cooldown;
} else {
    DB::prepare("INSERT INTO fc_fights (FC_loser, FC_winner, FC_date) VALUES (?,?,?)")->execute([$session_id, $Contestant['ACC_id'], time()]);
    DB::run("UPDATE cooldown SET CD_fc_fight = " . time() + $cooldown . " WHERE CD_acc_id = " . $session_id);

    echo 'Du slåss mot ' . $Contestant['ACC_username'] . ' og tapte!' . '<|>' . 'danger' . '<|>' . $cooldown;
}
