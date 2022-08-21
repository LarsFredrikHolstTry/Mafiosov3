<?php

include 'missionVariables.inc.php';

if ($missions > $missonUser) {
?>
    <div class="df mt-2 jcc">
        <h3><?= 'Oppdrag nr. ' . $missonUser + 1 ?></h3>
    </div>
    <div class="df mt-2 jcc">
        <?= $difficultyCats[$difficultyMission] ?>
    </div>
    <div class="container-tight py-4">
        <p class="text-muted">
            <?= $mission_text ?>
        </p>
        <div class="divide-y-2 mt-4">
            <h3>Oppdraget ditt er:</h3>
            <?php

            for ($i = 0; $i < count($missionCriteriaText); $i++) {
            ?>
                <div>
                    <?= $isSectionDone[$i] ? $isDoneIcon : $isNotDoneIcon ?>
                    <?= $missionCriteriaText[$i] ?>
                    <?= '<span class="fr text-muted">Du har ' . number($progress[$i]) . ' av ' . number($missionCriteria[$i]) . '</span>'; ?>
                </div>
            <?php }

            if ($isMissionDone) {
                echo '<div class="btn btn-square btn-success mt-2" id="missionDone">Hent belønning</div>';
            }

            ?>
        </div>
    </div>

<?php } else {
    echo $allMissionsDone;
} ?>


<script>
    $(document).ready(function() {
        $('#missionDone').click(function() {

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/mission/missionDone.inc.php',
                method: 'post',
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                        htmx.trigger("#rankbar", "rankbarUpdated");
                        htmx.trigger("#mission", "missionUpdate");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>