<?php

include 'lottoVariables.inc.php';

$amount = $_POST['amount'];

$lastCouponNo =     $couponRow ? $couponRow['LC_to'] + 1 : 0;
$newCouponFrom =    $lastCouponNo;
$newCouponTo =      $lastCouponNo + $amount;
$totalPrice =       $amount * $couponPrice;

if (!is_numeric($amount) || $amount < 0 || $amountOfCouponsSession + $amount > $maxCoupons) {
    echo 'Ugylidg antall kuponger ' . '<|>' . 'warning';
} else {
    if ($totalPrice > $money) {
        echo 'Du har ikke nok penger til å kjøpe ' . $amount . ' kuponger' . '<|>' . 'warning';
    } else {
        DB::run("INSERT INTO lottery_coupons (LC_acc_id, LC_from, LC_to, LC_date) VALUES (?,?,?,?)", [$session_id, $newCouponFrom, $newCouponTo, time()]);
        DB::run("UPDATE account_stat SET AS_money = AS_money - $totalPrice WHERE AS_id = $session_id");

        echo 'Du kjøpte ' . number($amount) . ' kuponger' . '<|>' . 'success';
    }
}
