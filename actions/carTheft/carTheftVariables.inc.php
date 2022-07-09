<?php
$bullets = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

$carTheftArr[0] = "E-Klasse";
$carTheftArr[1] = "C-Klasse";
$carTheftArr[2] = "S1-Klasse";
$carTheftArr[3] = "S2-Klasse";
$carTheftArr[4] = "R-Klasse";

$cooldown[0] = 30;  // 30 seconds
$cooldown[1] = 60;  // 60 seconds
$cooldown[2] = 120; // 120 seconds
$cooldown[3] = 200; // 200 seconds
$cooldown[4] = 320; // 320 seconds

$exp[0] = 1;
$exp[1] = 2;
$exp[2] = 3;
$exp[3] = 4;
$exp[4] = 5;

$chance[0] = $bullets >= 50 ? 90 : 45;
$chance[1] = $bullets >= 50 ? 80 : 40;
$chance[2] = $bullets >= 50 ? 60 : 30;
$chance[3] = $bullets >= 50 ? 40 : 20;
$chance[4] = $bullets >= 50 ? 20 : 10;
