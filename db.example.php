<?php

include_once 'env.php';

if (!session_id()) {
    session_start();
}

date_default_timezone_set('Europe/Oslo');

try {
    global $pdo;
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
