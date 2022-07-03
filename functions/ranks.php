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
$rank_to[12] =      1000000;

$rank_prize[0] = 10;
$rank_prize[1] = 10;
$rank_prize[2] = 10;
$rank_prize[3] = 10;
$rank_prize[4] = 10;
$rank_prize[5] = 10;
$rank_prize[6] = 10;
$rank_prize[7] = 10;
$rank_prize[8] = 10;
$rank_prize[9] = 10;
$rank_prize[10] = 10;
$rank_prize[11] = 10;
$rank_prize[12] = 10;

function rank_progress($rank, $exp, $rank_from, $rank_to)
{
    if (!$exp || $exp == 0) {
        return 0;
    } else {
        if ($rank == 12) {
            return 100;
        } elseif ($rank < 12) {
            $rankplusen = ($rank + 1);
            $percent4 = ($rank_from[$rankplusen] - $exp);
            $percent5 = ($rank_to[$rank] - $rank_from[$rank]);
            $percent6 = ($percent4 / $percent5) * 100;
            return 100 - $percent6;
        }
    }
}

function check_rankup($id, $rank, $exp, $rank_from, $rank_to, $rank_prize)
{
    if (rank_progress($rank, $exp, $rank_from, $rank_to) >= 100 && $rank < 12) {
        DB::run("UPDATE account_stat SET AS_rank = AS_rank + 1, AS_money = AS_money + " . $rank_prize[$rank + 1] . " WHERE AS_id = " . $id . "");

        // $text = " ranket opp til " . rank_list($rank + 1) . "";
        // $sql = "INSERT INTO last_events (LAEV_user, LAEV_text, LAEV_date) VALUES (?,?,?)";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute([$id, $text, time()]);

        // give_money($id, rank_prize($rank + 1), $pdo);
        // $text = "Gratulerer, du har ranket opp til " . rank_list($rank + 1) . " og får " . number(rank_prize($rank + 1)) . " kr";
        // send_notification($id, $text, $pdo);
    }
}
