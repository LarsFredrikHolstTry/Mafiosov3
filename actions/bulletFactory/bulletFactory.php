<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'bulletFactoryVariables.inc.php';

$bullets = DB::run("SELECT AS_bullets FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();


?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->bulletFactory; ?></h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image mb-3" src="actions/bulletFactory/img/bulletFactory.png" />
                <p class="text-muted">Kuler er viktig for å øke sjansen på kriminalitet, biltyveri og brekk. Dersom du har under 50 kuler vil du ha mye mindre sjanse enn om du har over 50 kuler.
                    For hver kriminelle handling du utfører vil du bruke litt kuler for å komme deg unna politiet. Det er derfor viktig å fylle på kuler
                    underveis. Du kan maks ha 500 kuler på deg om gangen.</p>
                <div class="container-tight py-4">
                    <div class="mb-3">
                        <label class="form-label">Antall kuler <span class="ml-05 text-muted">(<?= number($price_pr_bullet) ?> kr pr kule)</span></label>
                        <input type="text" id="number" class="form-control" name="example-text-input" value="<?= $max_bullets - $bullets ?>">
                        <div class="d-flex aic mt-2">
                            <i class="text-muted">50% av kjøpsumen går til staten</i>
                            <div class="btn btn-success btn-md ms-auto buy_bullets" id="transfer-btn">
                                Kjøp kuler
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    number_space("#number");

    $(document).ready(function() {
        $('.buy_bullets').click(function() {
            var value = $("#number").val();
            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/bulletFactory/buy_bullets.inc.php',
                method: 'post',
                data: {
                    value: value,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success' || feedbackType == 'danger') {
                        if (feedbackType == 'success') {
                            $('#number').val(0);
                            htmx.trigger("#bulletsUser", "bulletsUpdated");
                            htmx.trigger("#moneyInHand", "moneyHandUpdated");
                        }
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>