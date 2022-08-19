<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$acc_role = DB::run("SELECT ACC_role FROM account WHERE ACC_id = $session_id")->fetchColumn();

$badges[0] = '<div class="form-selectgroup-label d-flex align-items-center p-1">
<div>
    <span class="badge bg-pink-lt">Bugfix</span>
</div>
</div>';

$badges[1] = '<div class="form-selectgroup-label d-flex align-items-center p-1">
<div>
    <span class="badge bg-green-lt">Ny funksjon</span>
</div>
</div>';

$badges[2] = '<div class="form-selectgroup-label d-flex align-items-center p-1">
<div>
    <span class="badge bg-red-lt">Fjernet funksjon</span>
</div>
</div>';

$badges[3] = '<div class="form-selectgroup-label d-flex align-items-center p-1">
<div>
    <span class="badge bg-cyan-lt">Annet</span>
</div>
</div>';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Changelog</h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <?php if ($acc_role == 4) { ?>
                    <div class="container-tight py-4">
                        <h4>Legg in ny endring</h4>
                        <div class="mb-3">
                            <label class="form-label">Tittel</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Input placeholder">
                        </div>
                        <label class="form-label">Velg kategori (maks 1)</label>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex">
                            <?php for ($i = 0; $i < count($badges); $i++) { ?>
                                <label class="form-selectgroup-item">
                                    <input type="checkbox" id="<?= $i ?> class=" form-selectgroup-input">
                                    <?= $badges[$i] ?>
                                </label>
                            <?php } ?>
                        </div>
                        <div class="add_change btn btn-primary btn-square btn-sm mt-3">
                            Legg ut
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
            var value = value;
            $("#feedback-container").load("components/feedback.php");
        })
    })
</script>