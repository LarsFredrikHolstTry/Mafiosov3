<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$user = DB::run("SELECT AS_money, AS_health FROM account_stat WHERE AS_id = $session_id")->fetch();

$price = (100 - $user['AS_health']) * 100;

if ($price <= $user['AS_money']) {
    DB::run("UPDATE account_stat SET AS_health = 100 WHERE AS_id = " . $session_id . "");

    echo 'Du la deg inn på sykehus og har nå 100% helse!' . '<|>' . 'success';
} else {
    echo 'Du har ikke nok penger' . '<|>' . 'danger';
}
