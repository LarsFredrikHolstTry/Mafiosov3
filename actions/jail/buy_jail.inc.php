<?php
include '../../global-variables.php';
include '../../functions/cities.php';
include '../../db/PDODB.php';

$price = removeSpace($_POST['price']);

$user =         DB::run("SELECT AS_money, AS_city FROM account_stat WHERE AS_id = ?", [$session_id])->fetch();
$jail_busy =    DB::run("SELECT BU_city FROM business WHERE BU_city = ? AND BU_type = ?", [$user['AS_city'], 0])->fetchColumn();

if ($jail_busy) {
    echo 'Fengselet i ' . $city[$user['AS_city']] . ' har allerede en eier' . '<|>' . 'danger';
} elseif ($user['AS_money'] >= $price && !$jail_busy) {
    echo 'Gratulerer som ny eier av fengselet i ' . $city[$user['AS_city']] . '<|>' . 'success';
} else {
    echo 'Du har ikke nok penger til å kjøpe fengselet i ' . $city[$user['AS_city']] . '<|>' . 'danger';
}
