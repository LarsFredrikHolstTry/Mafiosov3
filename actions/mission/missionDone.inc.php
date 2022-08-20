<?php

include 'missionVariables.inc.php';

if ($isMissionDone) {
    DB::run("UPDATE account_stat SET AS_mission = AS_mission + 1, AS_money = AS_money + " . $payoutMoney . ", AS_exp = AS_exp + " . $payoutExp . " WHERE AS_id = " . $session_id);

    echo 'Du er ferdig med oppdraget og får ' . number($payoutMoney) . ' kr  og ' . number($payoutExp) . ' exp!' . '<|>' . 'success';
} else {
    echo 'Du er ikke ferdig med oppdraget enda!' . '<|>' . 'warning';
}
