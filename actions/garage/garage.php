<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../db/PDODB.php';

$total_car_value = 0;
$total_cars = 0;

$max_cars =        DB::run("SELECT US_max_cars FROM user_settings WHERE US_acc_id = ?", [$session_id])->fetchColumn();

$stmt = DB::run("SELECT GA_car, GA_damage from garage WHERE GA_acc_id = $session_id");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $total_car_value = $total_car_value + ($car_price[$row['GA_car']] - ($row['GA_damage'] / 100) * $car_price[$row['GA_car']]);
    $total_cars++;
}

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->garage; ?></h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" src="actions/garage/img/garasje.png" />
                <div hx-get="actions/garage/cars.php" id="garage" hx-trigger="load, sellCars"></div>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <span>
                        <span class="text-muted">Total verdi: <?= number($total_car_value) ?> kr</span>
                        <br>
                        <span class="text-muted">Antall plasser brukt: <?= number($total_cars) ?> / <?= number($max_cars) ?></span>
                    </span>

                    <?php if ($total_cars) { ?>
                        <div class="ms-auto">
                            <!-- <div class="btn bg-green btn-md">Selg valgte</div> -->
                            <div class="btn bg-blue btn-md" data-bs-toggle="modal" data-bs-target="#modal-small">Selg Alle</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../actions/garage/garage_sell_all_modal.php'; ?>