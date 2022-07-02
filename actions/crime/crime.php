<?php

include '../../global-variables.php';
include '../../functions/cooldown-textify.php';
include 'crimeVariables.inc.php';

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->crime; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/crime/img/kriminalitet.png" />
                <div class="table-responsive" id="crime_table">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Handling</th>
                                <th>Sjanse</th>
                                <th>Ventetid</th>
                                <th>Utbetaling</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($crime); $i++) { ?>
                                <tr class="do-crime cursor-pointer" id="<?= $i; ?>">
                                    <td><?= $crime[$i]; ?></td>
                                    <td class="text-muted"><?= $chance[$i] ?> %</td>
                                    <td class="text-muted"><?= seconds_to_minutes_and_seconds($cooldown[$i]); ?></td>
                                    <td class="text-muted"><?= number($payout_from[$i]) . ' - ' . number($payout_to[$i]) ?> kr</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.do-crime').click(function() {
            var alt = $(this).closest(".do-crime").attr("id");;

            $.ajax({
                url: 'actions/crime/crime.inc.php',
                method: 'post',
                data: {
                    alt: alt,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];
                    var cooldown = feedback[2];

                    if (feedbackType == 'success' || feedbackType == 'danger') {
                        if (feedbackType == 'success') {
                            htmx.trigger("#moneyInHand", "moneyHandUpdated");
                        }
                        $("#crime").removeClass("bg-green-lt");
                        $("#crime").addClass("bg-orange-lt");
                        $("#crime_table").hide().delay(cooldown * 1000).fadeIn(0);
                        $("#cooldown_crime").text(cooldown);
                        countdown(cooldown, "cooldown_crime", "crime");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>