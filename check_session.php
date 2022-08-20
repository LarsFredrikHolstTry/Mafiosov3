<?php
session_start();
if (!isset($_SESSION['ID'])) {
    echo 'noSession';
}
