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
                    <div class="alert alert-important alert-success alert-dismissible mt-1 bg-green-lt" role="alert">
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
                    <div class="markdown">
                        <h1>Velkommen til sykehuset i {by}</h1>
                        <p>Du har under 100% helse og kan legge deg inn på sykehus for 10 000kr</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var value = value;
            $("#feedback-container").load("components/feedback.html");
        })
    })
</script>