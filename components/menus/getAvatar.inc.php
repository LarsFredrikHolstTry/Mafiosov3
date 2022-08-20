<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$AS_avatar = DB::run("SELECT AS_avatar FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

?>

<span class="avatar avatar-sm" style="background-image: url(<?= $AS_avatar ?>)"></span>