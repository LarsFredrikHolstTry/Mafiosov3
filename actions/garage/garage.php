<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->garage; ?></h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/garage/img/garasje.png" />
                <div class="table-responsive" id="car-table">
                    <div hx-target="#car-table" hx-swap="innerHTML" hx-get="actions/garage/cars.php" hx-trigger="load"></div>
                </div>
            </div>
        </div>
    </div>
</div>