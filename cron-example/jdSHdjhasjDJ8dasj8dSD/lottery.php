<?php

include '../../env.php';
include '../../db/PDODB.php';
include '../../functions/numbers.php';

$winningNumber =  mt_rand(0, DB::run('SELECT LC_to FROM lottery_coupons ORDER BY LC_date DESC')->fetchColumn());
$winner = DB::run('SELECT LC_acc_id FROM lottery_coupons WHERE LC_to >= ' . $winningNumber . ' AND LC_from <= ' . $winningNumber)->fetchColumn();


$totalCouponsSold = 0;

$stmt = DB::run('SELECT LC_from, LC_to FROM lottery_coupons');
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $totalCouponsSold = $totalCouponsSold + ($row['LC_to'] - $row['LC_from']);
}

$prize = $totalCouponsSold * 850;

DB::run('INSERT INTO lottery_winners (LW_acc_id, LW_money, LW_date) VALUES (?,?,?)', [$winner, $prize, time()]);
DB::run('INSERT INTO notification (NO_acc_id, NO_text, NO_date) VALUES (?,?,?)', [$winner, 'Du vant ' . number($prize) . ' kr på lottoen!', time()]);
DB::run('DELETE FROM lottery_coupons');

echo 'Cron job runned succesfully!';
