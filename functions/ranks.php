<?php

$rank_arr[0] = "Giovane D'Onore";
$rank_arr[1] = "Uomini D'Onore";
$rank_arr[2] = "Picciotto";
$rank_arr[3] = "Sgarrista";
$rank_arr[4] = "Caporegime";
$rank_arr[5] = "Capodecina";
$rank_arr[6] = "Sotto Capo";
$rank_arr[7] = "Consigliere";
$rank_arr[8] = "Capo Bastone";
$rank_arr[9] = "Capo Crimini";
$rank_arr[10] = "Capofamiglia";
$rank_arr[11] = "Capo di Capi Re";
$rank_arr[12] = "Capo di Tuttu Capi";

$rank_from[0] =     0;
$rank_to[0] =       100;
$rank_from[1] =     $rank_to[0] + 1;
$rank_to[1] =       $rank_to[0] * 2;
$rank_from[2] =     $rank_to[1] + 1;
$rank_to[2] =       $rank_to[1] * 2;
$rank_from[3] =     $rank_to[2] + 1;
$rank_to[3] =       $rank_to[2] * 2;
$rank_from[4] =     $rank_to[3] + 1;
$rank_to[4] =       $rank_to[3] * 2;
$rank_from[5] =     $rank_to[4] + 1;
$rank_to[5] =       $rank_to[4] * 2;
$rank_from[6] =     $rank_to[5] + 1;
$rank_to[6] =       $rank_to[5] * 2;
$rank_from[7] =     $rank_to[6] + 1;
$rank_to[7] =       $rank_to[6] * 2;
$rank_from[8] =     $rank_to[7] + 1;
$rank_to[8] =       $rank_to[7] * 2;
$rank_from[9] =     $rank_to[8] + 1;
$rank_to[9] =       $rank_to[8] * 2;
$rank_from[10] =    $rank_to[9] + 1;
$rank_to[10] =      $rank_to[9] * 2;
$rank_from[11] =    $rank_to[10] + 1;
$rank_to[11] =      $rank_to[10] * 2;
$rank_from[12] =    $rank_to[11] + 1;
$rank_to[12] =      $rank_to[11] * 2;

function rank_progress($rank, $exp, $rank_from, $rank_to)
{
    if (!$exp || $exp == 0) {
        return 0;
    } else {
        if ($rank < 12) {
            $rankplusen = ($rank + 1);
            $percent4 = ($rank_from[$rankplusen] - $exp);
            $percent5 = ($rank_to[$rank] - $rank_from[$rank]);
            $percent6 = ($percent4 / $percent5) * 100;
            return $percent7 = (100 - $percent6);
        } elseif ($rank == 12) {
            return $percent7 = 100;
        }
    }
}
