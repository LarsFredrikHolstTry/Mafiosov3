<?php

$money_amount_from[0] =     0;
$money_amount_to[0] =       10;
$money_amount_from[1] =     $money_amount_to[0];
$money_amount_to[1] =       100;
$money_amount_from[2] =     $money_amount_to[1];
$money_amount_to[2] =       1000;
$money_amount_from[3] =     $money_amount_to[2];
$money_amount_to[3] =       5000;
$money_amount_from[4] =     $money_amount_to[3];
$money_amount_to[4] =       100000;
$money_amount_from[5] =     $money_amount_to[4];
$money_amount_to[5] =       250000;
$money_amount_from[6] =     $money_amount_to[5];
$money_amount_to[6] =       500000;
$money_amount_from[7] =     $money_amount_to[6];
$money_amount_to[7] =       1000000;
$money_amount_from[8] =     $money_amount_to[7];
$money_amount_to[8] =       2000000;
$money_amount_from[9] =     $money_amount_to[8];
$money_amount_to[9] =       5000000;
$money_amount_from[10] =    $money_amount_to[9];
$money_amount_to[10] =      10000000;
$money_amount_from[11] =    $money_amount_to[10];
$money_amount_to[11] =      50000000;
$money_amount_from[12] =    $money_amount_to[11];
$money_amount_to[12] =      100000000;
$money_amount_from[13] =    $money_amount_to[12];
$money_amount_to[13] =      250000000;
$money_amount_from[14] =    $money_amount_to[13];
$money_amount_to[14] =      500000000;
$money_amount_from[15] =    $money_amount_to[14];
$money_amount_to[15] =      1000000000;
$money_amount_from[16] =    $money_amount_to[15];
$money_amount_to[16] =      INF;

$money_rank[0] = "Uteligger";
$money_rank[1] = "Fattig";
$money_rank[2] = "Arbeider";
$money_rank[3] = "Langer";
$money_rank[4] = "Middel klasse";
$money_rank[5] = "Øvrige klasse";
$money_rank[6] = "Rik";
$money_rank[7] = "Middels rik";
$money_rank[8] = "Millionær";
$money_rank[9] = "Multimillionær";
$money_rank[10] = "Mangemillionær";
$money_rank[11] = "Skipsmegler";
$money_rank[12] = "Aksjemegler";
$money_rank[13] = "Børssjef";
$money_rank[14] = "Hotell-investor";
$money_rank[15] = "Oljesjeik";
$money_rank[16] = "Forretningsmagnat";

function money_rank($amount, $money_amount_from, $money_amount_to, $money_rank)
{

    $i = 0;

    while ($i < count($money_rank)) {
        if ($amount >= $money_amount_from[$i] && $amount < $money_amount_to[$i]) {
            return $money_rank[$i];
        }
        $i++;
    }
}
