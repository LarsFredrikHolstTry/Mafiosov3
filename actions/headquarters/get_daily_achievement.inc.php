<?php

include 'headquartersVariables.inc.php';

if (!$done) {
    echo 'Du er ikke ferdig med dagens utfordring helt enda! Kom tilbake når du er ferdig for en belønning' . '<|>' . 'warning';
} elseif ($done && $DS_row['DS_dailyChallenge'] == 0) {
    DB::run("UPDATE daily_stats SET DS_dailyChallenge = 1 WHERE DS_acc_id = " . $session_id);
    DB::run("UPDATE account_stat SET AS_money = AS_money + $money, AS_exp = AS_exp + $exp WHERE AS_id = " . $session_id);

    echo 'Godt jobbet! Du får ' . number($exp) . ' EXP og ' . number($money) . ' kr som belønning. Hvis du er klar for et vanskeligere oppdrag så har jeg det klart for deg' . '<|>' . 'success';
} elseif ($done && $DS_row['DS_dailyChallenge'] == 1) {
    DB::run("UPDATE daily_stats SET DS_dailyChallenge = 2 WHERE DS_acc_id = " . $session_id);
    DB::run("UPDATE account_stat SET AS_money = AS_money + $money, AS_exp = AS_exp + $exp WHERE AS_id = " . $session_id);

    echo 'Du er helt rå! Du får ' . number($exp) . ' EXP og ' . number($money) . ' kr som belønning. Kom tilbake i morgen for flere utfordringer!' . '<|>' . 'success';
} elseif ($DS_row['DS_dailyChallenge'] == 2) {
    echo 'Du er ferdig med alle dagens utfordringer!' . '<|>' . 'success';
}
