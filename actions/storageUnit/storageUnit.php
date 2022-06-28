<?php

include '../../global-variables.php';
include '../../functions/things.php';
include '../../db/PDODB.php';

$total_things_value = 0;
$total_things = 0;

$stmt = DB::run("SELECT ST_type from storage WHERE ST_acc_id = $session_id");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $total_things_value = $total_things_value + $thing_price[$row['ST_type']];
    $total_things++;
}

?>
<div class="col-12" id="container">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->storageUnit; ?></h3>
        </div>
        <div class="row align-items-center">
            <img class="center-image" style="width: auto;" src="actions/storageUnit/img/lager.png" />
            <div hx-get="actions/storageUnit/allThings.php" hx-trigger="load"></div>
        </div>
        <div class="card-footer">
            <div class="d-flex">
                <span>
                    <span class="text-muted">Total verdi: <?= number($total_things_value) ?> kr</span>
                    <br>
                    <span class="text-muted">Antall plasser brukt: <?= number($total_things) ?> / NaN</span>
                </span>

                <div class="ms-auto">
                    <div class="btn bg-green-lt btn-md">Selg valgte</div>
                    <div class="btn bg-blue-lt btn-md">Selg Alle</div>
                </div>

            </div>
        </div>
    </div>