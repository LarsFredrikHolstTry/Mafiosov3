<?php

include '../../global-variables.php';
include 'crimeVariables.inc.php';

$legal = [0, 1, 2, 3, 4, 5];
$alt = $_POST['alt'];
$crime_cd =         DB::run("SELECT CD_crime FROM cooldown WHERE CD_acc_id = $session_id")->fetchColumn();
$bullets =          DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = $session_id")->fetchColumn();
$session_city =     DB::run("SELECT AS_city FROM account_stat WHERE AS_id = $session_id")->fetchColumn();

if (!is_numeric($alt) || !in_array($alt, $legal)) {
    echo 'Ugyldig valg!' . '<|>' . 'warning';
    return;
}

if ($crime_cd > time()) {
    echo 'Du har ventetid!' . '<|>' . 'warning';
    return;
}

DB::run("UPDATE cooldown SET CD_crime = " . time() + $cooldown[$alt] . " WHERE CD_acc_id = " . $session_id);
if (mt_rand(0, 100) < $chance[$alt]) {
    $bullets_used = 0;
    if ($bullets >= 10) {
        $bullets_used = mt_rand(0, 10);
    }

    $money = mt_rand($payout_from[$alt], $payout_to[$alt]);
    $bullet_string = $bullets_used > 0 ? 'På vei fra åstedet måtte du brukte ' . number($bullets_used) . ' kuler og du mistet 2% helse i angrepet' : '';

    $log = array(
        "outcome" => "success",
        "city" => $session_city,
        "moneyEarned" => $money,
        "expEarned" => $exp[$alt],
        "bullets_used" => $bullets_used,
        "alternative" => $alt,
    );

    DB::prepare("INSERT INTO logs (LOGS_page, LOGS_json, LOGS_date, LOGS_acc_id) VALUES (?, ?, ?, ?)")->execute(["crime", json_encode($log), time(), $session_id]);

    DB::run("UPDATE account_stat SET AS_bullets = AS_bullets - " . $bullets_used . ", AS_money = AS_money + " . $money . ", AS_health = AS_health - 2, AS_exp = AS_exp + " . $exp[$alt] . " WHERE AS_id = " . $session_id);
    DB::run("UPDATE daily_stats SET DS_crime = DS_crime + 1, DS_exp = DS_exp + " . $exp[$alt] . " WHERE DS_acc_id = " . $session_id);

    echo 'Du stjal ' . number($money) . ' kr! ' . $bullet_string . ' ' . '<|>' . 'success' . '<|>' . $cooldown[$alt];
} else {
    $log = array(
        "outcome" => "failed",
        "city" => $session_city,
        "alternative" => $alt,
    );

    DB::prepare("INSERT INTO logs (LOGS_page, LOGS_json, LOGS_date, LOGS_acc_id) VALUES (?, ?, ?, ?)")->execute(["crime", json_encode($log), time(), $session_id]);

    echo 'Du feilet kriminaliteten!' . '<|>' . 'danger' . '<|>' . $cooldown[$alt];
}
