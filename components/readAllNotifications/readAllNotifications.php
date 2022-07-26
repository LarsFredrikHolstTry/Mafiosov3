<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

DB::run("UPDATE notification SET NO_unread = 0 WHERE NO_acc_id = " . $session_id . " AND NO_unread = 1");
