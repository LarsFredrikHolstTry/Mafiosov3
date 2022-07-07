<?php

include '../../global-variables.php';
include '../../functions/cities.php';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h3>
                    <?= $useLang->action->airport; ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="row row-cards">
        <?php
        for ($i = 0; $i < count($city); $i++) {
        ?>
            <div class="col-4">
                <div class="card">
                    <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url(actions/airport/img/cities/<?= $i; ?>.png)"></div>
                    <div class="card-body">
                        <h3 class="card-title"><span class="flag flag-country-<?= $flag[$i] ?> me-1"></span> <?= $city[$i] ?></h3>
                        <ul class="text-muted list-unstyled">
                            <li>Territorium: Lorem Ipsum</li>
                            <li>Pris: 15 240 kr</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="<?= $i ?>" value="<?= $i ?>" class="travel btn btn-bitbucket">Reis til <?= $city[$i]; ?></button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.travel').click(function() {
            var city = $(this).attr('id');
            $("#feedback-container").load("components/feedback.html");

            $.ajax({
                url: 'actions/airport/airport.inc.php',
                method: 'post',
                data: {
                    city: city,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    htmx.trigger("#city", "cityUpdated");
                    htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    htmx.trigger("#leftmenu", "leftMenuUpdate");

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>