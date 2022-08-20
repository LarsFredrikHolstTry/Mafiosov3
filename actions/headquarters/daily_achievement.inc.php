<?php

include 'headquartersVariables.inc.php';

if (!$allDone) { ?>
    <?php
    for ($i = 0; $i < count($daily_challenges); $i++) {
        $percentage = ($DS_row['DS_' . $ds_daily_challenges[$i]] / $DC_row['DC_' . $daily_challenges[$i]]) * 100;
    ?>
        <div>
            <div class="d-flex mb-1 mt-3">
                <div><span class="d-inline-flex align-items-center lh-1"><?= $title[$i] ?></span></div>
                <div class="ms-auto">
                    <span class="text-muted d-inline-flex align-items-center lh-1">
                        <?= $DS_row['DS_' . $ds_daily_challenges[$i]] ?> av <?= $DC_row['DC_' . $daily_challenges[$i]] ?>
                    </span>
                </div>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-green" style="width: <?= $percentage ?>%">
                </div>
            </div>
        </div>
    <?php } ?>
    <p class="mt-3 text-info">Belønning: <?= number($exp) ?> EXP og <?= number($money) ?> kr</p>

    <?php if ($done) { ?>
        <div class="btn btn-square mt-3" id="get_daily_achievement">
            Hent belønning
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="alert alert-important alert-success alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
            </div>
            <div>
                Du er ferdig med alle dagens utfordringer! Kom tilbake i morgen for flere oppdrag.
            </div>
        </div>
    </div>
<?php } ?>


<script>
    $(document).ready(function() {
        $('#get_daily_achievement').click(function() {

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/headquarters/get_daily_achievement.inc.php',
                method: 'post',
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#daily_achievement", "daily_achievement");
                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                        htmx.trigger("#rankbar", "rankbarUpdated");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>