<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../db/PDODB.php';

$total_car_value = 0;
$total_cars = 0;

$max_cars =        DB::run("SELECT US_max_cars FROM user_settings WHERE US_acc_id = ?", [$session_id])->fetchColumn();

$stmt = DB::run("SELECT GA_car from garage WHERE GA_acc_id = $session_id");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $total_car_value = $total_car_value + $car_price[$row['GA_car']];
    $total_cars++;
}

?>
<div class="col-12" id="container">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->garage; ?></h3>
        </div>
        <div class="row align-items-center">
            <img class="center-image" style="width: auto;" src="actions/garage/img/garasje.png" />
            <div hx-get="actions/garage/cars.php" hx-trigger="load"></div>
        </div>
        <div class="card-footer">
            <div class="d-flex">
                <span>
                    <span class="text-muted">Total verdi: <?= number($total_car_value) ?> kr</span>
                    <br>
                    <span class="text-muted">Antall plasser brukt: <?= number($total_cars) ?> / <?= number($max_cars) ?></span>
                </span>

                <div class="ms-auto">
                    <a href="#" class="btn bg-green-lt btn-md">Selg valgte</a>
                    <a href="#" class="btn bg-blue-lt btn-md">Selg Alle</a>
                </div>

            </div>
        </div>
    </div>