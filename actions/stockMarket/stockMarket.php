<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Aksjemarked</h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div hx-get="actions/stockMarket/renderStockGraph.inc.php?id=0" hx-trigger="load"></div>
                </div>
                <div class="col-6">
                    <div hx-get="actions/stockMarket/renderStockGraph.inc.php?id=1" hx-trigger="load"></div>
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
</script>