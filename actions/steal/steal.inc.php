<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/things.php';
include '../../functions/cars.php';

$cooldown = 60;
$exp = 2;

$legalFeedbackROS = ['specificPlayer', 'randomPlayer'];
$legalFeedbackCTM = ['car', 'thing', 'money'];

$randomOrSpecific = $_POST['randomOrSpecific'];
$carOrThingOrMoney = $_POST['carOrThingOrMoney'];
$player = $_POST['player'];
$player = strtolower($player);

$success = false;

$crime_cd = DB::run("SELECT CD_steal FROM cooldown WHERE CD_acc_id = $session_id")->fetchColumn();

if ($crime_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

if (!in_array($randomOrSpecific, $legalFeedbackROS) || !in_array($carOrThingOrMoney, $legalFeedbackCTM)) {
    echo 'Ugyldig valg' . '<|>' . 'warning';
    return;
}

if (mt_rand(0, 2) == 2) {
    DB::run("UPDATE cooldown SET CD_steal = " . time() + $cooldown . " WHERE CD_acc_id = " . $session_id);
    echo 'Du feilet på ransforsøket!' . '<|>' . 'danger' . '<|>' . $cooldown;
    return;
}

if ($player != null) {
    $playerRow = DB::run("SELECT ACC_id, ACC_username FROM account WHERE LOWER(ACC_username) = '" . strtolower($player) . "'")->fetch();
    if (!$playerRow) {
        echo 'Ugyldig spiller' . '<|>' . 'warning';
        return;
    }
} else {
    $playerRow = DB::run("SELECT ACC_id, ACC_username FROM account WHERE NOT ACC_id = '" . $session_id . "'  ORDER BY RAND() LIMIT 1")->fetch();
}

if ($playerRow['ACC_id'] == $session_id) {
    echo 'Du kan ikke rane deg selv..' . '<|>' . 'warning';
    return;
}

$myFamilyId = DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = '" . $session_id . "'")->fetchColumn() ?? false;
$familyAtWar = DB::run("SELECT FW_warId, FW_family1, FW_family2 FROM family_war WHERE FW_family1 = $myFamilyId OR FW_family2 = $myFamilyId")->fetch() ?? false;

if ($familyAtWar) {
    $atWarWith = $familyAtWar['FW_family1'] == $myFamilyId ? $familyAtWar['FW_family2'] : $familyAtWar['FW_family1'];
    $scoreString = $familyAtWar['FW_family1'] == $myFamilyId ? 'FW_family2Score' : 'FW_family1Score';

    $nemesis = [];

    $stmt = DB::run("SELECT FM_acc_id FROM family_member WHERE FM_family_id = ?", [$atWarWith]);
    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
        array_push($nemesis, $row['FM_acc_id']);
    }
}

if ($carOrThingOrMoney == 'car') {
    $carRow = DB::run("SELECT GA_id, GA_car FROM garage WHERE GA_acc_id = " . $playerRow['ACC_id'] . " ORDER BY RAND() LIMIT 1")->fetch();

    if ($carRow) {
        DB::run("UPDATE garage SET GA_acc_id = $session_id WHERE GA_acc_id = " . $playerRow['ACC_id']);

        if ($familyAtWar && in_array($playerRow['ACC_id'], $nemesis)) {
            $action = 'stjal ' . $car_name[$carRow['GA_car']] . ' fra ' . $playerRow['ACC_username'];
            DB::prepare("INSERT INTO family_war_activity (FWA_warId, FWA_family, FWA_account_id, FWA_action, FWA_date) VALUES (?,?,?,?,?)")->execute([$familyAtWar['FW_warId'], $myFamilyId, $session_id, $action, time()]);
        }

        $success = true;

        echo 'Du stjal ' . $car_name[$carRow['GA_car']] . ' fra ' . $playerRow['ACC_username'] . '<|>' . 'success' . '<|>' . $cooldown;
    } else {
        echo $playerRow['ACC_username'] . ' har ingen biler i garasjen' . '<|>' . 'danger' . '<|>' . $cooldown;
    }
} elseif ($carOrThingOrMoney == 'thing') {
    $thingRow = DB::run("SELECT ST_id, ST_type FROM storage WHERE ST_acc_id = " . $playerRow['ACC_id'] . " ORDER BY RAND() LIMIT 1")->fetch();

    if ($thingRow) {
        DB::run("UPDATE storage SET ST_acc_id = $session_id WHERE ST_id = " . $thingRow['ST_id']);

        if ($familyAtWar && in_array($playerRow['ACC_id'], $nemesis)) {
            $action = 'stjal ' . $thing_name[$thingRow['ST_type']] . ' fra ' . $playerRow['ACC_username'];
            DB::prepare("INSERT INTO family_war_activity (FWA_warId, FWA_family, FWA_account_id, FWA_action, FWA_date) VALUES (?,?,?,?,?)")->execute([$familyAtWar['FW_warId'], $myFamilyId, $session_id, $action, time()]);
        }

        $success = true;

        echo 'Du stjal ' . $thing_name[$thingRow['ST_type']] . ' fra ' . $playerRow['ACC_username'] . '<|>' . 'success' . '<|>' . $cooldown;
    } else {
        echo $playerRow['ACC_username'] . ' har ingen ting på lageret' . '<|>' . 'danger' . '<|>' . $cooldown;
    }
} elseif ($carOrThingOrMoney == 'money') {
    $moneyOnHand = DB::run("SELECT AS_money FROM account_stat WHERE AS_id = " . $playerRow['ACC_id'])->fetchColumn();

    $stealAmount = 0;

    if ($moneyOnHand > 0) {
        $stealAmount = mt_rand(1, $moneyOnHand);
    }

    if ($stealAmount > 0) {
        DB::run("UPDATE account_stat SET AS_money = AS_money + $stealAmount WHERE AS_id = " . $session_id);
        DB::run("UPDATE account_stat SET AS_money = AS_money - $stealAmount WHERE AS_id = " . $playerRow['ACC_id']);

        if ($familyAtWar && in_array($playerRow['ACC_id'], $nemesis)) {
            $action = 'stjal ' . number($stealAmount) . ' kr fra ' . $playerRow['ACC_username'];
            DB::prepare("INSERT INTO family_war_activity (FWA_warId, FWA_family, FWA_account_id, FWA_action, FWA_date) VALUES (?,?,?,?,?)")->execute([$familyAtWar['FW_warId'], $myFamilyId, $session_id, $action, time()]);
        }

        $success = true;

        echo 'Du stjal ' . number($stealAmount) . ' kr fra ' . $playerRow['ACC_username'] . '' . '<|>' . 'success' . '<|>' . $cooldown;
    } else {
        echo $playerRow['ACC_username'] . ' har ingen penger på seg' . '<|>' . 'danger' . '<|>' . $cooldown;
    }
}

if ($success && $familyAtWar && in_array($playerRow['ACC_id'], $nemesis)) {
    $scoreString = $familyAtWar['FW_family1'] ==
        $myFamilyId ?
        "UPDATE family_war SET FW_family1Score = FW_family1Score + 1 WHERE FW_warId = '" . $familyAtWar['FW_warId'] . "'"
        :
        "UPDATE family_war SET FW_family2Score = FW_family2Score + 1 WHERE FW_warId = '" . $familyAtWar['FW_warId'] . "'";

    DB::run($scoreString);
}

if ($success) {
    DB::run("UPDATE daily_stats SET DS_steal = DS_steal + 1, DS_exp = DS_exp + " . $exp . " WHERE DS_acc_id = " . $session_id);
    DB::run("UPDATE account_stat SET AS_exp = AS_exp + " . $exp . " WHERE AS_id = " . $session_id . "");
}

DB::run("UPDATE cooldown SET CD_steal = " . time() + $cooldown . " WHERE CD_acc_id = " . $session_id);
