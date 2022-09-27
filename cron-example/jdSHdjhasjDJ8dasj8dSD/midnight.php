<?php

include '../../env.php';
include '../../db/PDODB.php';

/**
 * Update daily challenge
 * 
 * Update the challenges that is given to users at midnight
 */
DB::run("UPDATE 
    daily_challenge 
SET 
    DC_crime = " . mt_rand(10, 20) . ",
    DC_carTheft = " . mt_rand(8, 16) . ",
    DC_theft = " . mt_rand(8, 16) . ",
    DC_crime_hard = " . mt_rand(50, 100) . ",
    DC_carTheft_hard = " . mt_rand(45, 80) . ",
    DC_theft_hard = " . mt_rand(45, 80) . ",
    DC_steal_hard = " . mt_rand(25, 50) . "");

/**
 * Reset users daily statistics
 */
DB::run("UPDATE 
daily_stats 
SET 
DS_crime = 0,
DS_carTheft = 0,
DS_theft = 0,
DS_steal = 0,
DS_exp = 0,
DS_dailyChallenge = 0");

/**
 * Give interests from bank
 * 
 * 10% interests is given from the bank
 * If the mafioso has over 10 mill in the bank he only gets 1 mill
 * 
 */
DB::run("UPDATE account_stat
SET AS_bankmoney = CASE
   WHEN AS_bankmoney < 10000000 THEN AS_bankmoney + 0.1 * AS_bankmoney
   ELSE AS_bankmoney + 1000000
END");

echo 'Cron job runned succesfully!';
