<?php

include 'missionVariables.inc.php';

$mission_text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

$missionCriteria[0] = 10;
$missionCriteria[1] = 10;
$missionCriteria[2] = 10;

$missionCriteriaText[0] = "Utfør " . $missionCriteria[0] . " kriminaliteter";
$missionCriteriaText[1] = "Utfør " . $missionCriteria[1] . " biltyveri";
$missionCriteriaText[2] = "Utfør " . $missionCriteria[2] . " brekk";

$payoutMoney = 1000;
$payoutExp = 10;

$isMissionDone = false;

$isSectionDone[0] = DB::run("SELECT COUNT(*) FROM logs WHERE LOGS_page = 'crime' AND LOGS_acc_id = $session_id AND LOGS_json like '%success%'")->fetchColumn() > $missionCriteria[0];
$isSectionDone[1] = DB::run("SELECT COUNT(*) FROM logs WHERE LOGS_page = 'carTheft' AND LOGS_acc_id = $session_id AND LOGS_json like '%success%'")->fetchColumn() > $missionCriteria[1];
$isSectionDone[2] = DB::run("SELECT COUNT(*) FROM logs WHERE LOGS_page = 'theft' AND LOGS_acc_id = $session_id AND LOGS_json like '%success%'")->fetchColumn() > $missionCriteria[2];

$done = true;

?>

<div class="df mt-2 jcc">
    <?= $difficultyCats[$difficultyMission[0]] ?>
</div>
<div class="container-tight py-4">
    <p class="text-muted">
        <?= $mission_text ?>
    </p>
    <div class="divide-y-2 mt-4">
        <?php

        for ($i = 0; $i < count($missionCriteriaText); $i++) {

            if (!$isSectionDone[$i]) {
                $done = false;
            }

        ?>
            <div>
                <?= $isSectionDone[$i] ? $isDoneIcon : $isNotDoneIcon ?>
                <?= $missionCriteriaText[$i] ?>
            </div>
        <?php }

        if ($isMissionDone) {
            echo '<div class="btn btn-square btn-success mt-2">Hent belønning</div>';
        }

        ?>
    </div>
</div>