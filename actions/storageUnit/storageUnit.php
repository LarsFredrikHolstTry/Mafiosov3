<?php

include '../../global-variables.php';
include '../../functions/things.php';
include '../../db/PDODB.php';

$total_things_value = 0;
$total_things = 0;

$max_things =           DB::run("SELECT US_max_things FROM user_settings WHERE US_acc_id = ?", [$session_id])->fetchColumn();
$stmt =                 DB::run("SELECT ST_type from storage WHERE ST_acc_id = $session_id");

while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $total_things_value = $total_things_value + $thing_price[$row['ST_type']];
    $total_things++;
}

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->storageUnit; ?></h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" src="actions/storageUnit/img/lager.png" />
                <div hx-get="actions/storageUnit/allThings.php" id="things" hx-trigger="load, sellThings"></div>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <span>
                        <span class="text-muted">Total verdi: <?= number($total_things_value) ?> kr</span>
                        <br>
                        <span class="text-muted">Antall plasser brukt: <?= number($total_things) ?> / <?= number($max_things) ?></span>
                    </span>

                    <?php if ($total_things) { ?>
                        <div class="ms-auto">
                            <!-- <div class="btn bg-green btn-md">Selg valgte</div> -->
                            <div class="btn bg-blue btn-md" data-bs-toggle="modal" data-bs-target="#modal-small">Selg Alle</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../actions/storageUnit/storageUnit_sell_all_modal.php'; ?>