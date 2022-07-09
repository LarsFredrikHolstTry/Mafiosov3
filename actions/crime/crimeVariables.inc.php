<?php
include '../../db/PDODB.php';
$bullets = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

$crime[0] = "Stjel fra brusautomat";
$crime[1] = "Stjel fra en gammel dame";
$crime[2] = "Ran 7-eleven";
$crime[3] = "lorem";
$crime[4] = "lorem";
$crime[5] = "Bankhack";

$cooldown[0] = 20;
$cooldown[1] = 25;
$cooldown[2] = 35;
$cooldown[3] = 50;
$cooldown[4] = 70;
$cooldown[5] = 90;

$exp[0] = 1;
$exp[1] = 2;
$exp[2] = 3;
$exp[3] = 4;
$exp[4] = 5;
$exp[5] = 6;

$chance[0] = $bullets >= 50 ? 100 : 40;
$chance[1] = $bullets >= 50 ? 85 : 35;
$chance[2] = $bullets >= 50 ? 75 : 30;
$chance[3] = $bullets >= 50 ? 65 : 25;
$chance[4] = $bullets >= 50 ? 60 : 20;
$chance[5] = $bullets >= 50 ? 55 : 15;

$payout_from[0] = 150;
$payout_to[0] = 350;
$payout_from[1] = 450;
$payout_to[1] = 1050;
$payout_from[2] = 1550;
$payout_to[2] = 5050;
$payout_from[3] = 5550;
$payout_to[3] = 10050;
$payout_from[4] = 10550;
$payout_to[4] = 25050;
$payout_from[5] = 10000;
$payout_to[5] = 990000;
