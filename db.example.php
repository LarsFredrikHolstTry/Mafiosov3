<?php

if (!session_id()) {
    session_start();
}

date_default_timezone_set('Europe/Oslo');

$db_host = "localhost"; //localhost server 
$db_user = "root"; //database username
$db_password = ""; //database password   
$db_name = "mafioso"; //database name

try {
    global $pdo;
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
