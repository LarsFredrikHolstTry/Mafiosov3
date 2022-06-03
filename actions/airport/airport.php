<?php

include '../../global-variables.php';
include '../../functions/cities.php';

?>
<div class="col-12" id="container">
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h3>
                    <?= $useLang->action->airport; ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="row row-cards">
        <?php
        for ($i = 0; $i < count($city); $i++) {
        ?>
            <div class="col-4">
                <div class="card">
                    <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url(actions/airport/img/cities/<?= $i; ?>.png)"></div>
                    <div class="card-body">
                        <h3 class="card-title"><span class="flag flag-country-<?= $flag[$i] ?> me-1"></span> <?= $city[$i] ?></h3>
                        <ul class="text-muted list-unstyled">
                            <li>Territorium: Camorra</li>
                            <li>Pris: 15 240 kr</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary">Reis til <?= $city[$i]; ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>