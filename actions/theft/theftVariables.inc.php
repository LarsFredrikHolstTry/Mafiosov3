<?php
include '../../db/PDODB.php';

$bullets = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

$theftArr[0] = "Ran tatovering studio";
$theftArr[1] = "Ran restaurant";
$theftArr[2] = "Stjel verktøy fra byggeplass";
$theftArr[3] = "Ran casino";

$cooldown[0] = 120;
$cooldown[1] = 260;
$cooldown[2] = 420;
$cooldown[3] = 600;

$exp[0] = 15;
$exp[1] = 2;
$exp[2] = 3;
$exp[3] = 4;

$chance[0] = $bullets >= 50 ? 90 : 60;
$chance[1] = $bullets >= 50 ? 80 : 40;
$chance[2] = $bullets >= 50 ? 60 : 30;
$chance[3] = $bullets >= 50 ? 40 : 10;
