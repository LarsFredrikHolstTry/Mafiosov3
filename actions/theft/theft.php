<?php

include '../../global-variables.php';
include '../../functions/cooldown-textify.php';
include 'theftVariables.inc.php';

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->theft; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/theft/img/brekk.png" />
                <div class="table-responsive" id="theft_table">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Handling</th>
                                <th>Sjanse</th>
                                <th>Ventetid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($theftArr); $i++) { ?>
                                <tr class="do-theft cursor-pointer" id="<?= $i; ?>">
                                    <td><?= $theftArr[$i]; ?></td>
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
        $('.do-theft').click(function() {
            var alt = $(this).closest(".do-theft").attr("id");

            $.ajax({
                url: 'actions/theft/theft.inc.php',
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
                            var getThingAmount = +$('#total_things').text();
                            var newThingAmount = getThingAmount + 1;
                            $('#total_things').text(newThingAmount);
                        }
                        $("#theft").removeClass("bg-green-lt");
                        $("#theft").addClass("bg-orange-lt");
                        $("#theft_table").hide().delay(cooldown * 1000).fadeIn(0);
                        $("#cooldown_theft").text(cooldown);
                        countdown(cooldown, "cooldown_theft", "theft");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>