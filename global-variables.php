<?php

ob_start();
include '../../lang/lang.php';
include 'functions/numbers.php';
include 'functions/dates.php';

if (!session_id()) {
    session_start();
}

$session_id = $_SESSION['ID'];
