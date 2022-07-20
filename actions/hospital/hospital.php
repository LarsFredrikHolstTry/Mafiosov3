<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$health =           DB::run("SELECT AS_health FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->hospital; ?></h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" src="actions/hospital/img/hospital.png" />
                <p class="df jcc mt-2">Eieren av sykehuset i {by} er {nick}</p>
                <?php if ($health == 100) { ?>
                    <div class="alert alert-important alert-success alert-dismissible mt-1" role="alert">
                        <div class="d-flex jcc">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity mr-05" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                                </svg>
                            </div>
                            <div>
                                Du har 100% helse og har ikke behov for operasjon
                            </div>
                        </div>
                    </div>
                <?php } elseif ($health < 100) { ?>
                    <div class="markdown" style="text-align: center;">
                        <p>Du har under 100% helse og kan legge deg inn på sykehus for <?= number((100 - $health) * 100) ?>kr</p>
                        <div id="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart-broken" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                                <path d="M12 6l-2 4l4 3l-2 4v3"></path>
                            </svg>
                            Legg deg inn på sykehus
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/hospital/hospital.inc.php',
                method: 'post',
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#healthbar", "healthbarUpdated");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })
</script>