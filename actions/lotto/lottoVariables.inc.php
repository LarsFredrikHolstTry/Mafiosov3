<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$maxCoupons = 1000;
$couponPrice = 1000;

$money =                DB::run("SELECT AS_money FROM account_stat WHERE AS_id = $session_id")->fetchColumn();
$couponRow =            DB::run("SELECT LC_from, LC_to FROM lottery_coupons ORDER BY LC_date DESC")->fetch();
$sessionCouponRow =     DB::run("SELECT LC_from, LC_to FROM lottery_coupons WHERE LC_acc_id = $session_id")->fetch();

$amountOfCoupons = 0;

$stmt = DB::run("SELECT LC_from, LC_to FROM lottery_coupons WHERE LC_acc_id = $session_id");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $amount = $sessionCouponRow['LC_to'] - $sessionCouponRow['LC_from'];
    $amountOfCoupons = $amountOfCoupons + $amount;
}
