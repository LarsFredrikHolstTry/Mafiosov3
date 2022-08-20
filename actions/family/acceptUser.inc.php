<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$id = $_POST['id'];

$fap_row = DB::run("SELECT * FROM family_application WHERE FAP_id = $id")->fetch();

DB::run("INSERT INTO family_member (FM_acc_id,FM_family_id,FM_joined) VALUES (?,?,?)", [$fap_row['FAP_acc_id'], $fap_row['FAP_family'], time()]);
DB::run("DELETE FROM family_application WHERE FAP_acc_id = " . $fap_row['FAP_acc_id'] . "");

echo 'Du tok inn ny consigliere til familien! Sørg for å ta mafiosoen godt i mot.' . '<|>' . 'success';
