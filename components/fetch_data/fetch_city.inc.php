<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/cities.php';

$AS_city = DB::run("SELECT AS_city FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

echo $city[$AS_city];
