<?php

include '../../global-variables.php';
include '../../functions/cooldown-textify.php';

$crime[0] = "Veldig enkel";
$crime[1] = "Enkel";
$crime[2] = "Middels";
$crime[3] = "Vanskelig";
$crime[4] = "Avansert";
$crime[5] = "Ekspert";

$cooldown[0] = 15;
$cooldown[1] = 25;
$cooldown[2] = 35;
$cooldown[3] = 50;
$cooldown[4] = 70;
$cooldown[5] = 90;

$payout_from[0] = 150;
$payout_to[0] = 350;
$payout_from[1] = 450;
$payout_to[1] = 1050;
$payout_from[2] = 1550;
$payout_to[2] = 5050;
$payout_from[3] = 5550;
$payout_to[3] = 10050;
$payout_from[4] = 10550;
$payout_to[4] = 25050;
$payout_from[5] = 21550;
$payout_to[5] = 55050;

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
                <div class="table-responsive">
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
                                    <td class="text-muted">100%</td>
                                    <td class="text-muted"><?= seconds_to_minutes_and_seconds($cooldown[$i]); ?></td>
                                    <td class="text-muted"><?= number($payout_from[$i]) . ' - ' . number($payout_to[$i]) ?></td>
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

                    // htmx.trigger("#bankMoney", "moneyUpdated");
                    // htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>