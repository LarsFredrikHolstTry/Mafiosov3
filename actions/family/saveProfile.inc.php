<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$profileText = $_POST['profileText'];
$family = $_POST['family'];

DB::run("UPDATE family SET FA_profile = ? WHERE FA_id = ?", [$profileText, $family]);


echo 'Profilen ble oppdatert' . '<|>' . 'success';
