<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

echo
str_replace(
    '{value}',
    number(DB::run("SELECT AS_bankmoney FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn()),
    $useLang->index->money
);
