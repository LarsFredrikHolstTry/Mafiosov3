<?php

include 'missionVariables.inc.php';

$missonUser =   DB::run("SELECT AS_mission FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

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
                <?php if ($missonUser < $missions) { ?>
                    <div hx-get="actions/mission/<?= $missonUser ?>.php" id="mission" hx-trigger="load, missionUpdate"></div>
                <?php } else {
                    echo 'Du har gjort alle oppdragene! Utfør dagens oppdrag til det kommer fler oppdrag';
                } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submit').click(function() {

            var alt = 'lorem';

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/folder/file.inc.php',
                method: 'post',
                data: {
                    alt: alt,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                        htmx.trigger("#rankbar", "rankbarUpdated");
                        htmx.trigger("#bulletsUser", "bulletsUpdated");
                        htmx.trigger("#healthbar", "healthbarUpdated");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>