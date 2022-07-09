<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$bullets = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

echo number($bullets) . ' kuler';
