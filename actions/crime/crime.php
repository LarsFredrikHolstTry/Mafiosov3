<?php

include '../../global-variables.php';
include '../../functions/cooldown-textify.php';
include 'crimeVariables.inc.php';

$bullets = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>
    <?php if ($bullets < 50) { ?>
        <div class="alert alert-important alert-info alert-dismissible " role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle mr-05" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        <polyline points="11 12 12 12 12 16 13 16"></polyline>
                    </svg>
                </div>
                <div>
                    Det anbefales å ha minst 50 kuler på deg for høyere sjanse
                </div>
            </div>
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    <?php } ?>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->crime; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" src="actions/crime/img/kriminalitet.png" />
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

            $("#feedback-container").load("components/feedback.html");

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
                            htmx.trigger("#rankbar", "rankbarUpdated");
                            htmx.trigger("#bulletsUser", "bulletsUpdated");
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