<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../db/PDODB.php';

$total_car_value = 0;
$total_cars = 0;

$max_cars =        DB::run("SELECT US_max_cars FROM user_settings WHERE US_acc_id = ?", [$session_id])->fetchColumn();

$stmt = DB::run("SELECT GA_car from garage WHERE GA_acc_id = $session_id");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $total_car_value = $total_car_value + $car_price[$row['GA_car']];
    $total_cars++;
}

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->garage; ?></h3>
            <div class="ms-auto">
                <span class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" src="actions/garage/img/garasje.png" />
                <div hx-get="actions/garage/cars.php" id="garage" hx-trigger="load, sellCars"></div>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <span>
                        <span class="text-muted">Total verdi: <?= number($total_car_value) ?> kr</span>
                        <br>
                        <span class="text-muted">Antall plasser brukt: <?= number($total_cars) ?> / <?= number($max_cars) ?></span>
                    </span>

                    <?php if ($total_cars) { ?>
                        <div class="ms-auto">
                            <div class="btn bg-green-lt btn-md">Selg valgte</div>
                            <div class="btn bg-blue-lt btn-md" id="sell_all">Selg Alle</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sell_all').click(function() {
                $("#feedback-container").load("components/feedback.html");

                var alt = 2;
                $.ajax({
                    url: 'actions/garage/garage_sell_all.inc.php',
                    method: 'post',
                    success: function(response) {
                        var feedback = response;
                        feedback = feedback.split("<|>");

                        var feedbackText = feedback[0];
                        var feedbackType = feedback[1];

                        if (feedbackType == 'success') {
                            if (feedbackType == 'success') {
                                var getCarAmount = +$('#total_cars').text();
                                var newCarAmount = 0;
                                $('#total_cars').text(newCarAmount);
                                htmx.trigger("#rankbar", "rankbarUpdated");
                                htmx.trigger("#moneyInHand", "moneyHandUpdated");
                                htmx.trigger("#garage", "sellCars");
                            }
                        }

                        feedbackReturn(feedbackText, feedbackType);
                    }
                });
            });
        });
    </script>