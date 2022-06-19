<?php

include '../../global-variables.php';

?>
<div class="col-3">
    <div class="row row-cards">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <a href="#" class="btn btn-ghost-teal">Gå i bunker</a>
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
                                    echo '<span class="text-muted fr">15 / 200</span>';
                                    break;
                                case 'storageUnit':
                                    echo '<span class="text-muted fr">55 / 200</span>';
                                    break;
                                case 'airport':
                                    echo '<span class="text-muted fr">Klar!</span>';
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