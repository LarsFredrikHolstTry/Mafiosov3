<?php

include '../../functions/cities.php';
include '../../global-variables.php';
include '../../db/PDODB.php';

$cityPost = $_POST['city'];

if (!is_numeric($cityPost) || $cityPost < 0 || $cityPost > count($city)) {
    echo 'Ugyldig verdi fra liste ' . '<|>' . 'danger';
} else {
    $familyId =             DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetchColumn();
    $bullets =              DB::run("SELECT FA_bullets FROM family WHERE FA_id = ?", [$familyId])->fetchColumn();
    $territoriumRow =       DB::run("SELECT count(TE_city) FROM territorium WHERE TE_family_id = ?", [$familyId])->fetchColumn();

    if ($territoriumRow >= 2) {
        echo 'Familien eier allerede 2 byer ' . '<|>' . 'danger';
    } elseif ($bullets < 1000) {
        echo 'Familien har ikke nok kuler til å ta over ' . $city[$cityPost] . '<|>' . 'danger';
    } else {
        DB::prepare("INSERT INTO territorium (TE_family_id, TE_city) VALUES (?,?)")->execute([$familyId, $cityPost]);
        DB::run("UPDATE family SET FA_bullets = FA_bullets - ? WHERE FA_id = ?", [1000, $familyId]);

        echo 'Du har tatt over ' . $city[$cityPost] . '<|>' . 'success';
    }
}
