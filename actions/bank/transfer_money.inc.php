<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$username =     $_POST['username'];
$message =      $_POST['message'];
$money =        removeSpace($_POST['money']);

$receiver_id =  DB::run("SELECT ACC_id FROM account WHERE ACC_username = ?", [$username])->fetchColumn();
$money_user =   DB::run("SELECT AS_bankmoney FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

if (is_numeric($money) && $money > 0) {
    if ($money > $money_user) {
        echo 'Du kan ikke overføre mer penger enn du har i banken! ' . '<|>' . 'danger';
    } elseif ($receiver_id) {
        DB::run("UPDATE account_stat SET AS_bankmoney = AS_bankmoney + " . $money . " WHERE AS_id = " . $receiver_id . "");
        DB::run("UPDATE account_stat SET AS_bankmoney = AS_bankmoney - " . $money . " WHERE AS_id = " . $session_id . "");
        DB::prepare("INSERT INTO bank_transfer (BT_from, BT_to, BT_money, BT_message, BT_date) VALUES (?,?,?,?,?)")->execute([$session_id, $receiver_id, $money, $message, time()]);

        echo 'Du overførte ' . number($money) . ' kr til ' . $username . ' ' . '<|>' . 'success';
    } else {
        echo 'Brukeren eksisterer ikke! ' . '<|>' . 'danger';
    }
} else {
    echo 'Ugyldig sum!' . '<|>' . 'danger';
}
