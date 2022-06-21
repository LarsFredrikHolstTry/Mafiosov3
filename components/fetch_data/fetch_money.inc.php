<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$money_hand = DB::run("SELECT AS_money FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

echo str_replace('{value}', number($money_hand), $useLang->index->money);
