<?php

include '../../global-variables.php';
include '../../functions/things.php';
include '../../functions/ranks.php';
include 'theftVariables.inc.php';

function hasMaxThings($user_id, $amountOfThings)
{
    $total_things =         DB::run("SELECT count(*) FROM storage WHERE ST_acc_id = ?", [$user_id])->fetchColumn();
    $max_things =           DB::run("SELECT US_max_things FROM user_settings WHERE US_acc_id = ?", [$user_id])->fetchColumn();

    if ($amountOfThings + $total_things > $max_things) {
        return true;
    } else {
        return false;
    }
}

$theft_cd =         DB::run("SELECT CD_theft FROM cooldown WHERE CD_acc_id = ?", [$session_id])->fetchColumn();
$user =             DB::run("SELECT AS_city, AS_rank, AS_EXP FROM account_stat WHERE AS_id=?", [$session_id])->fetch();

$legal = [0, 1, 2, 3];
$alt = $_POST['alt'];

if (!is_numeric($alt) || !in_array($alt, $legal)) {
    echo 'Ugyldig valg' . '<|>' . 'warning';
    return;
}

if ($theft_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

if (hasMaxThings($session_id, 1)) {
    echo 'Lageret er fullt!' . '<|>' . 'warning';
    return;
}

switch ($alt) {
    case 0:
        $thing_outcome = mt_rand(0, 7);
        break;
    case 1:
        $thing_outcome = mt_rand(8, 15);
        break;
    case 2:
        $thing_outcome = mt_rand(16, 23);
        break;
    case 3:
        $thing_outcome = mt_rand(24, 31);
        break;
}

DB::run("UPDATE cooldown SET CD_theft = " . time() + $cooldown[$alt] . " WHERE CD_acc_id = " . $session_id);

if (mt_rand(0, 100) < $chance[$alt]) {
    $bullets_used = mt_rand(0, 1) == 1 && $bullets > 10 ? mt_rand(0, 10) : mt_rand(0, $bullets);
    $bullet_string = $bullets_used > 0 ? 'På vei fra åstedet måtte du bruke ' . number($bullets_used) . ' kuler og du mistet 2% helse i angrepet' : '';

    $log = array(
        "outcome" => "success",
        "city" => $user['AS_city'],
        "thingStolen" => $thing_outcome,
        "thingValue" => $thing_price[$thing_outcome],
        "expEarned" => $exp[$alt],
        "bullets_used" => $bullets_used,
        "alternative" => $alt,
    );

    DB::prepare("INSERT INTO logs (LOGS_page, LOGS_json, LOGS_date, LOGS_acc_id) VALUES (?, ?, ?, ?)")->execute(["theft", json_encode($log), time(), $session_id]);

    DB::run("UPDATE account_stat SET AS_bullets = AS_bullets - " . $bullets_used . ", AS_health = AS_health - 2, AS_exp = AS_exp + " . $exp[$alt] . " WHERE AS_id = " . $session_id . "");
    DB::run("INSERT INTO storage (ST_acc_id, ST_type) VALUES (?,?)", [$session_id, $thing_outcome]);
    DB::run("UPDATE daily_stats SET DS_theft = DS_theft + 1, DS_exp = DS_exp + " . $exp[$alt] . " WHERE DS_acc_id = " . $session_id);

    echo 'Du stjal ' . $thing_name[$thing_outcome] . ' til en verdi av ' . number($thing_price[$thing_outcome]) . ' kr! ' . '<|>' . 'success' . '<|>' . $cooldown[$alt];
} else {
    $log = array(
        "outcome" => "failed",
        "alternative" => $alt,
    );

    DB::prepare("INSERT INTO logs (LOGS_page, LOGS_json, LOGS_date, LOGS_acc_id) VALUES (?, ?, ?, ?)")->execute(["carTheft", json_encode($log), time(), $session_id]);

    echo 'Du feilet brekket!' . '<|>' . 'danger' . '<|>' . $cooldown[$alt];
}
