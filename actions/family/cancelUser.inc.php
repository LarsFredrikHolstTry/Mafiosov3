<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$id = $_POST['id'];

$fap_row = DB::run("SELECT * FROM family_application WHERE FAP_id = $id")->fetch();

DB::run("DELETE FROM family_application WHERE FAP_id = " . $id . "");

echo 'Du avbrøt søknaden.' . '<|>' . 'success';
