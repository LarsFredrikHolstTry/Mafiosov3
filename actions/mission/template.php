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

?>

<div class="container-tight py-4">
    <p class="text-muted">
        <?= $mission_text ?>
    </p>
    <div class="divide-y-2 mt-4">
        <?php

        for ($i = 0; $i < count($missionCriteriaText); $i++) {
            $isMissionDone = true;

        ?>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M9 12l2 2l4 -4"></path>
                </svg>
                <?= $missionCriteriaText[$i] ?>
            </div>
        <?php }

        if ($isMissionDone) {
            echo '<div class="btn btn-square btn-success">Hent belønning</div>';
        }

        ?>
    </div>
</div>