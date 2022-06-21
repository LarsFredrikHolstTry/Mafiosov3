<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$total_cars = DB::run("SELECT count(*) FROM garage WHERE GA_acc_id = ?", [$session_id])->fetchColumn();

echo $total_cars . ' / NaN';
