<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$missions = 3;
$isMissionDone = true;
$missonUser =   DB::run("SELECT AS_mission FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

$difficultyCats[0] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-green-lt">Enkel</span>';
$difficultyCats[1] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-yellow-lt">Middels</span>';
$difficultyCats[2] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-red-lt">Vanskelig</span>';
$difficultyCats[3] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-purple-lt">Ekspert</span>';

$isDoneIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
    <circle cx="12" cy="12" r="9"></circle>
    <path d="M9 12l2 2l4 -4"></path>
</svg>';

$isNotDoneIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
<circle cx="12" cy="12" r="9"></circle>
</svg>';

$allMissionsDone = '
<div class="mt-3 alert alert-success" role="alert">
    <div class="d-flex">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
        </div>
        <div>
            <h4 class="alert-title">Wow! Du har utført alle oppdragene</h4>
            <div class="text-muted">Du har utført alle oppdragene på spillet. Flere oppdrag blir lagt til kontinuerlig, så gjerne utfør dagens oppdrag mens du venter på nye oppdrag!</div>
        </div>
    </div>
</div>';

switch ($missonUser) {
        /**
     * Oppdrag nr 1 
     * 
     * Utfør 10 krim
     * 10 biltyveri
     * 10 brekk
     * 
     */
    case 0:
        $mission_text = "Velkommen til Mafioso! For at du skal bli en ekte Mafioso er det viktig å vite hvordan du gjør kriminelle handlinger.
        Selv om Mafia livet er mye mer enn å stjele penger fra 7-eleven og rane hus, så er dette noe av det mest fundementale
        du trenger å vite. Jeg kommer til å guide deg rundt for å gjøre deg en mektig mafioso.";
        $difficultyMission = 0;

        $missionCriteria[0] = 10;
        $missionCriteria[1] = 10;
        $missionCriteria[2] = 10;

        $missionCriteriaText[0] = "Utfør " . $missionCriteria[0] . " kriminaliteter";
        $missionCriteriaText[1] = "Utfør " . $missionCriteria[1] . " biltyveri";
        $missionCriteriaText[2] = "Utfør " . $missionCriteria[2] . " brekk";

        $payoutMoney = 1000;
        $payoutExp = 10;

        $isSectionDone[0] = DB::run("SELECT COUNT(*) FROM logs WHERE LOGS_page = 'crime' AND LOGS_acc_id = $session_id AND LOGS_json like '%success%'")->fetchColumn() >= $missionCriteria[0];
        $isSectionDone[1] = DB::run("SELECT COUNT(*) FROM logs WHERE LOGS_page = 'carTheft' AND LOGS_acc_id = $session_id AND LOGS_json like '%success%'")->fetchColumn() >= $missionCriteria[1];
        $isSectionDone[2] = DB::run("SELECT COUNT(*) FROM logs WHERE LOGS_page = 'theft' AND LOGS_acc_id = $session_id AND LOGS_json like '%success%'")->fetchColumn() >= $missionCriteria[2];
        break;

        /**
         * Oppdrag nr 2 
         * 
         * Skaff 200 kuler
         * 
         */
    case 1:
        $mission_text = "Godt jobbet! Du merket kanskje at det ble litt vanskelig å utføre kriminelle handlinger og mest sannsynelig
        skaffet deg noen kuler. Det jeg ønsker at du gjør er å skaffe 200 kuler slik at du kan holde på med kriminelle handlinger en god
        stund før du går tom.";

        $difficultyMission = 1;

        $missionCriteria[0] = 200;

        $missionCriteriaText[0] = "Skaff " . $missionCriteria[0] . " kuler";

        $payoutMoney = 50000;
        $payoutExp = 10;

        $isSectionDone[0] = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = $session_id")->fetchColumn() >= $missionCriteria[0];
        break;
        /**
         * Oppdrag nr 3 
         * 
         * 200 slåsspoeng 
         * vinn 20 kamper
         */
    case 2:
        $mission_text = "Godt jobbet! Du har vist at du klarer å utføre kriminelle handlinger, jeg ønsker å gi deg et viktig oppdrag.
        Dersom du går over til Fight Club har du mulighet for å trene enten styrke, fysikk eller hurtighet. Disse vil gi deg slåsspoeng
        basert på hvilket valg du tar. Jeg anbefaler deg å ta styrke, da går du raskere opp i slåsspoeng.
        Det jeg ønsker at du skal gjøre er å trene deg opp til 200 slåsspoeng.
        Deretter må du vinne 20 kamper. Andre mafiosoer kan slåss mot deg og du vil også få disse opp på listen inne på fight club.
        ";
        $difficultyMission = 0;

        $missionCriteria[0] = 200;
        $missionCriteria[1] = 20;

        $missionCriteriaText[0] = "Oppnå " . $missionCriteria[0] . " slåsspoeng";
        $missionCriteriaText[1] = "Vinn " . $missionCriteria[1] . " slåsskamper";

        $payoutMoney = 5000;
        $payoutExp = 20;

        $isSectionDone[0] = DB::run("SELECT AS_fightpoints FROM account_stat WHERE AS_id = $session_id")->fetchColumn() >= $missionCriteria[0];
        $isSectionDone[1] = DB::run("SELECT COUNT(*) FROM fc_fights WHERE FC_winner = $session_id")->fetchColumn() >= $missionCriteria[1];
        break;
}

/**
 * Check to see if mission is really done
 */
if ($missonUser <= $missions) {
    for ($i = 0; $i < count($missionCriteriaText); $i++) {

        if (!$isSectionDone[$i]) {
            $isMissionDone = false;
        }
    }
}
