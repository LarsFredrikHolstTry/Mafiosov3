<?php

include 'missionVariables.inc.php';


?>

<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Oppdrag</h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <img class="center-image" src="actions/mission/img/mission.png" />
                <?php if ($missions > $missonUser) { ?>
                    <div hx-get="actions/mission/mission_main.php" id="mission" hx-trigger="load, missionUpdate"></div>
                <?php } else {
                    echo $allMissionsDone;
                } ?>
            </div>
        </div>
    </div>
</div>