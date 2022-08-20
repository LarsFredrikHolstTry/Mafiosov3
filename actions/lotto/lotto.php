<?php

include 'lottoVariables.inc.php';

$lotteryWinnersRow =  DB::run("SELECT LW_acc_id, LW_money FROM lottery_winners")->fetch();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Lotto</h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <img class="center-image mb-3" src="actions/lotto/img/lotto.png" />
                <div class="col-5">
                    <h3>Regler</h3>
                    <p class="text-muted">
                        Det er mulig å kjøpe opp mot <?= number($maxCoupons) ?> kuponger til lottoen.
                        Premien regnes ut slik: <br>antall kuponger solgt * <?= number($couponPrice) ?>
                        <br>10% av kjøpesummen går til eieren av territorium
                    </p>
                    <span class="badge bg-yellow-lt">14 millioner i førstepremiepott</span>
                    <br>
                    <em class="text-muted small">15 000 kuponger solgt</em>
                    <div class="df aic mt-3 jcsb">
                        <h3>Antall kuponger</h3><span class="text-muted small">Du har <?= $amountOfCoupons ?> kuponger</span>
                    </div>
                    <input type="text" class="btn-square form-control" id="number" placeholder="Maks <?= number($maxCoupons) ?> kuponger..." />
                    <div class="mt-2 btn-square btn btn-success" id="buy_coupons">
                        Kjøp kuponger
                    </div>
                </div>
                <div class="col-7">
                    <h3>Siste vinnere</h3>
                    <?php if (!$lotteryWinnersRow) {
                        echo '<span class="text-warning">Det finnes ingen tidligere vinnere</span>';
                    } else { ?>
                        <table>

                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#buy_coupons').click(function() {
            var amount = $("#number").val();

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/lotto/buyCoupons.inc.php',
                method: 'post',
                data: {
                    amount: amount,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    }

                    // TODO: Work on this to introduce toast on errors
                    // else {
                    //     $.toast({
                    //         text: feedbackText,
                    //         icon: 'error',
                    //         showHideTransition: 'slide',
                    //         hideAfter: false,
                    //         stack: 5,
                    //         position: 'bottom-left',
                    //     });
                    // }

                    feedbackReturn(feedbackText, feedbackType);

                }
            });
        });
    });
</script>