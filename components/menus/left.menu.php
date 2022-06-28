<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$total_cars =       DB::run("SELECT count(*) FROM garage WHERE GA_acc_id = ?", [$session_id])->fetchColumn();
$total_things =     DB::run("SELECT count(*) FROM storage WHERE ST_acc_id = ?", [$session_id])->fetchColumn();

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
                        <div hx-get="actions/<?= $key ?>/<?= $key ?>.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="list-group-item list-group-item-action cursor-pointer" id="htmxForm">
                            <?= $value ?>

                            <?php

                            switch ($key) {
                                case 'garage':
                            ?>
                                    <span class="text-muted fr">
                                        <span id="total_cars"><?= $total_cars ?></span> / NaN
                                    </span>
                                <?php
                                    break;
                                case 'storageUnit':
                                ?>
                                    <span class="text-muted fr">
                                        <span id="total_things"><?= $total_things ?></span> / NaN
                                    </span>
                            <?php
                                    break;
                                case 'airport':
                                    echo '<span class="text-muted fr">NaN</span>';
                                    break;
                            }

                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>