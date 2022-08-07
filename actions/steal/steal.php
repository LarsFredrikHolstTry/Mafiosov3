<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">


                <h3 class="card-title text-capitalize"><?= $useLang->action->placebo; ?></h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="container-tight py-4">
                <div class="row">
                    <div class="col-6">
                        <div class="form-label">Hva ønsker du å stjele?</div>
                        <div>
                            <label class="form-selectgroup-item mb-1">
                                <input type="radio" name="icons" value="home" class="form-selectgroup-input" checked>
                                <span class="form-selectgroup-label" style="text-align: left;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="7" y="9" width="14" height="10" rx="2"></rect>
                                        <circle cx="14" cy="14" r="2"></circle>
                                        <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path>
                                    </svg>
                                    <span>Penger</span>
                                </span>
                            </label>
                            <label class="form-selectgroup-item mb-1">
                                <input type="radio" name="icons" value="home" class="form-selectgroup-input">
                                <span class="form-selectgroup-label" style="text-align: left;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-car" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="7" cy="17" r="2"></circle>
                                        <circle cx="17" cy="17" r="2"></circle>
                                        <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5"></path>
                                    </svg>
                                    <span>Bil</span>
                                </span>
                            </label>
                            <label class="form-selectgroup-item">
                                <input type="radio" name="icons" value="home" class="form-selectgroup-input">
                                <span class="form-selectgroup-label" style="text-align: left;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-warehouse" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 21v-13l9 -4l9 4v13"></path>
                                        <path d="M13 13h4v8h-10v-6h6"></path>
                                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
                                    </svg>
                                    <span>Ting</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-label">Velg mafioso</div>
                        <div>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" checked>
                                <span class="form-check-label">Stjel fra tilfeldig spiller</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" id="specificCheck" class="form-check-input" onclick="showSpecificInput()">
                                <span class="form-check-label">Stjel fra spesifikk spiller</span>
                            </label>
                            <div id="specificPlayerInput" style="display:none" class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Spiller...">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 btn btn-primary">Stjel</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var value = value;
            $("#feedback-container").load("components/feedback.php");
        })
    })

    $(document).on('click', 'input[type="checkbox"]', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });
</script>