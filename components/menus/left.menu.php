<?php

include '../../global-variables.php';

?>
<div class="col-3">
    <div class="row row-cards">
        <div class="col-12">

            <div class="card">
                <div class="card-body">

                </div>
                <div class="list-group list-group-flush">
                    <?php

                    foreach ($sidebarConfig as $key => $value) {

                    ?>
                        <a hx-post="actions/<?= $key ?>/<?= $key ?>.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="list-group-item list-group-item-action" href="#"><?= $value ?></a>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- if active class="list-group-item list-group-item-action active" aria-current="true" -->