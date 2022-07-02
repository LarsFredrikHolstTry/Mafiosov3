<?php


include '../../global-variables.php';

?>

<div class="col-12">
    <div class="row row-cards">
        <?php

        foreach ($topActionBar as $key => $value) {

        ?>
            <div class="col-2">
                <a hx-post="actions/<?= $key ?>/<?= $key ?>.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="no-style" href="#">
                    <div class="btn bg-green-lt btn-md w-100" id="<?= $key ?>">
                        <div class=" row align-items-center">
                            <div class="col">
                                <div class="font-weight-medium">
                                    <?= $value ?>
                                </div>
                                <div class="text-muted" id="cooldown_<?= $key ?>">
                                    Klar
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php } ?>
    </div>
</div>