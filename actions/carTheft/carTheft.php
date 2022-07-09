<?php

include '../../global-variables.php';
include '../../functions/cooldown-textify.php';
include '../../db/PDODB.php';
include 'carTheftVariables.inc.php';

$carTheftCooldown =     DB::run("SELECT CD_carTheft FROM cooldown WHERE CD_acc_id=?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->carTheft; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" src="actions/carTheft/img/biltyveri.png" />
                <?php include 'cooldown.php'; ?>
                <div class="table-responsive" id="carTheft_table">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Handling</th>
                                <th>Sjanse</th>
                                <th>Ventetid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($carTheftArr); $i++) { ?>
                                <tr class="do-crime cursor-pointer" id="<?= $i; ?>">
                                    <td><?= $carTheftArr[$i]; ?></td>
                                    <td class="text-muted"><?= $chance[$i] ?>%</td>
                                    <td class="text-muted"><?= seconds_to_minutes_and_seconds($cooldown[$i]); ?></td>
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
            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/carTheft/carTheft.inc.php',
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
                            var getCarAmount = $('#total_cars').text();
                            var newCarAmount = getCarAmount + 1;
                            $('#total_cars').text($('#total_cars').text());
                            htmx.trigger("#rankbar", "rankbarUpdated");
                        }
                        $("#cooldown_carTheft").removeClass("text-success");
                        $("#cooldown_carTheft").addClass("text-danger");
                        $("#carTheft_table").hide().delay(cooldown * 1000).fadeIn(0);
                        $("#cooldown_carTheft").text(cooldown);
                        countdown(cooldown, "cooldown_carTheft");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>