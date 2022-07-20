<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

DB::run("UPDATE account SET ACC_last_active = " . time() . " WHERE ACC_id = " . $session_id . "");
