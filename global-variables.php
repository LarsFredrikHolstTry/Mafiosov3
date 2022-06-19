<?php

ob_start();
include '../../lang/lang.php';
include 'functions/numbers.php';
include 'functions/dates.php';

if (!session_id()) {
    session_start();
}

$interest = number(1000); // TODO: Remove this

$session_id = $_SESSION['ID'];
