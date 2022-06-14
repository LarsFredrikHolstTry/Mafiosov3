<?php

include '../../functions/cities.php';
include '../../global-variables.php';
include '../../db/PDODB.php';

$price = 1000000;
$city_name = DB::run("SELECT AS_city FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->jail; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/jail/img/fengsel.png" />
                <script>
                    var feedbackText = 'Det er for tiden ingen i fengsel';
                    var feedbackType = 'info';

                    feedbackReturn(feedbackText, feedbackType);
                </script>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Kjøp fengsel</h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <p>
                    Det er for tiden ingen som eier fengselet i <?= $city[$city_name] ?><br>
                    Du kan kjøpe fengselet for <?= number($price); ?> kr
                </p>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-small">
                    Kjøp fengsel
                </button>
            </div>
        </div>
    </div>

    <?php include '../../actions/jail/modals.php'; ?>

</div>

<script>
    $(document).ready(function() {
        $('#buy_jail').click(function() {
            var price = <?= $price; ?>

            $.ajax({
                url: 'actions/jail/buy_jail.inc.php',
                method: 'post',
                data: {
                    price: price,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>