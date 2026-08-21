<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$ACC_row =  DB::run("SELECT * FROM account WHERE ACC_id = $session_id")->fetch();
$AS_row =   DB::run("SELECT * FROM account_stat WHERE AS_id = $session_id")->fetch();

$DC_row =   DB::run("SELECT * FROM daily_challenge")->fetch();
$DS_row =   DB::run("SELECT * FROM daily_stats WHERE DS_acc_id = $session_id")->fetch();

if (!$AS_row) {
    DB::run(
        "INSERT INTO account_stat (AS_id, AS_money, AS_bankmoney, AS_EXP, AS_rank, AS_health, AS_points, AS_bullets, AS_city, AS_mission, AS_fightpoints, AS_avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [$session_id, 1000, 0, 0, 0, 100, 0, 0, 0, 0, 0, 'img/avatars/standard_avatar.png']
    );
    $AS_row = DB::run("SELECT * FROM account_stat WHERE AS_id = ?", [$session_id])->fetch();
}

if (!$DC_row) {
    DB::run("INSERT INTO daily_challenge (DC_crime, DC_carTheft, DC_theft, DC_crime_hard, DC_carTheft_hard, DC_theft_hard, DC_steal_hard) VALUES (?, ?, ?, ?, ?, ?, ?)", [10, 8, 8, 50, 45, 45, 25]);
    $DC_row = DB::run("SELECT * FROM daily_challenge")->fetch();
}

if (!$DS_row) {
    DB::run(
        "INSERT INTO daily_stats (DS_acc_id, DS_crime, DS_carTheft, DS_theft, DS_steal, DS_exp, DS_dailyChallenge) VALUES (?, ?, ?, ?, ?, ?, ?)",
        [$session_id, 0, 0, 0, 0, 0, 0]
    );
    $DS_row = DB::run("SELECT * FROM daily_stats WHERE DS_acc_id = ?", [$session_id])->fetch();
}

$done = true;
$allDone = $DS_row['DS_dailyChallenge'] == 2 ? true : false;
$daily_challenges = [];
$ds_daily_challenges = [];

$exp = 0;
$money = 0;

if ($DS_row['DS_dailyChallenge'] == 0) {
    $daily_challenges[0] = 'crime';
    $daily_challenges[1] = 'carTheft';
    $daily_challenges[2] = 'theft';
} elseif ($DS_row['DS_dailyChallenge'] == 1) {
    $daily_challenges[0] = 'crime_hard';
    $daily_challenges[1] = 'carTheft_hard';
    $daily_challenges[2] = 'theft_hard';
    $daily_challenges[3] = 'steal_hard';
}

if ($DS_row['DS_dailyChallenge'] == 0) {
    $ds_daily_challenges[0] = 'crime';
    $ds_daily_challenges[1] = 'carTheft';
    $ds_daily_challenges[2] = 'theft';
} elseif ($DS_row['DS_dailyChallenge'] == 1) {
    $ds_daily_challenges[0] = 'crime';
    $ds_daily_challenges[1] = 'carTheft';
    $ds_daily_challenges[2] = 'theft';
    $ds_daily_challenges[3] = 'steal';
}

if ($DS_row['DS_dailyChallenge'] == 0) {
    $title[0] = "Kriminalitet <span class='badge bg-green-lt' style='margin-left: 8px'>Lett</span>";
    $title[1] = "Biltyveri <span class='badge bg-green-lt' style='margin-left: 8px'>Lett</span>";
    $title[2] = "Brekk <span class='badge bg-green-lt' style='margin-left: 8px'>Lett</span>";
} elseif ($DS_row['DS_dailyChallenge'] == 1) {
    $title[0] = "Kriminalitet <span class='badge bg-orange-lt' style='margin-left: 8px'>Vanskelig</span>";
    $title[1] = "Biltyveri <span class='badge bg-orange-lt' style='margin-left: 8px'>Vanskelig</span>";
    $title[2] = "Brekk <span class='badge bg-orange-lt' style='margin-left: 8px'>Vanskelig</span>";
    $title[3] = "stjel <span class='badge bg-orange-lt' style='margin-left: 8px'>Vanskelig</span>";
}

if ($DS_row['DS_dailyChallenge'] == 0) {
    $exp_pr_activity = 2;
    $money_pr_activity = 2500;
} elseif ($DS_row['DS_dailyChallenge'] == 1) {
    $exp_pr_activity = 4;
    $money_pr_activity = 5000;
}

if (!$allDone) {
    for ($i = 0; $i < count($daily_challenges); $i++) {
        $exp =      $exp + $exp_pr_activity * $DC_row['DC_' . $daily_challenges[$i]];
        $money =    $money + $money_pr_activity * $DC_row['DC_' . $daily_challenges[$i]];

        if ($DS_row['DS_' . $ds_daily_challenges[$i]] < $DC_row['DC_' . $daily_challenges[$i]]) {
            $done = false;
        }
    }
}
