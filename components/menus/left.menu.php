<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$total_cars = DB::run("SELECT count(*) FROM garage WHERE GA_acc_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-3">
    <div class="row row-cards">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="btn bg-green-lt cursor-pointer">Gå i bunker</div>
                </div>
                <div class="list-group list-group-flush">
                    <?php

                    foreach ($sidebarConfig as $key => $value) {

                    ?>
                        <a hx-post="actions/<?= $key ?>/<?= $key ?>.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="list-group-item list-group-item-action" href="#">
                            <?= $value ?>

                            <?php

                            switch ($key) {
                                case 'garage':
                            ?>
                                    <span class="text-muted fr" hx-get="components/fetch_data/total_cars.inc.php" id="totalCars" hx-trigger="carsUpdated">
                                        <?= $total_cars ?> / NaN
                                    </span>
                            <?php
                                    break;
                                case 'storageUnit':
                                    echo '<span class="text-muted fr">NaN / NaN</span>';
                                    break;
                                case 'airport':
                                    echo '<span class="text-muted fr">NaN</span>';
                                    break;
                            }

                            ?>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>