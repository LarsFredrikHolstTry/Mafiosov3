<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

if (isset($_POST['uniqueId'])) {
    $uniqueId = $_POST['uniqueId'];
    $messageRow =   DB::run("SELECT * FROM pm WHERE PM_uniqueId = '" . $uniqueId . "'")->fetch();
    $message =      $_POST['message'];
    $to =           $messageRow['PM_from'] == $session_id ? $messageRow['PM_to'] : $messageRow['PM_from'];

    DB::prepare("INSERT INTO pm (PM_uniqueId, PM_message, PM_from, PM_to, PM_date) VALUES (?, ?, ?, ?, ?)")->execute([$uniqueId, $message, $session_id, $to, time()]);

    echo 'Meldingen ble sendt!' . '<|>' . 'success';
}
