<?php

include '../../global-variables.php';
include '../../functions/cooldown-textify.php';

$carTheftArr[0] = "E-Klasse";
$carTheftArr[1] = "C-Klasse";
$carTheftArr[2] = "S1-Klasse";
$carTheftArr[3] = "S2-Klasse";
$carTheftArr[4] = "R-Klasse";
$carTheftArr[5] = "X-Klasse";

$cooldown[0] = 20;
$cooldown[1] = 30;
$cooldown[2] = 50;
$cooldown[3] = 70;
$cooldown[4] = 90;
$cooldown[5] = 120;



?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->carTheft; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/carTheft/img/biltyveri.png" />
                <div class="table-responsive">
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
                                    <td class="text-muted">100%</td>
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

                    htmx.trigger("#totalCars", "carsUpdated");
                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>