<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$total_cars =           DB::run("SELECT count(*) FROM garage WHERE GA_acc_id = ?", [$session_id])->fetchColumn();
$total_things =         DB::run("SELECT count(*) FROM storage WHERE ST_acc_id = ?", [$session_id])->fetchColumn();
$user_settings =        DB::run("SELECT US_max_cars, US_max_things FROM user_settings WHERE US_acc_id = ?", [$session_id])->fetch();
$active_city =          DB::run("SELECT AS_city FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

?>
<div class="card">
    <div class="card-body">
        <div class="df aic">
            <div class="btn bg-green cursor-pointer" id="bunker_in">Gå i bunker</div>
            <div>
                <p class="lh-base" style="margin: 0; margin-left: 1rem"><strong>Pris: 1000kr</strong><br>
                    <span class="text-muted small">Tid: 24t</span>
                </p>

            </div>
        </div>
    </div>
    <div class="list-group list-group-flush">
        <?php

        if ($active_city == 0) {
            echo '
                <div 
                hx-get="actions/lufthansaHeist/lufthansaHeist.php" 
                hx-trigger="click" 
                hx-target="#container" 
                hx-swap="outerHTML" 
                class="list-group-item list-group-item-action cursor-pointer" 
                id="htmxForm">Lufthansa Heist</div>';
        }

        ?>
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
                            <span id="total_cars"><?= $total_cars ?></span>
                            /
                            <span id="max_cars"><?= $user_settings['US_max_cars'] ?></span>
                        </span>
                    <?php
                        break;
                    case 'storageUnit':
                    ?>
                        <span class="text-muted fr">
                            <span id="total_things"><?= $total_things ?></span>
                            /
                            <span id="max_things"><?= $user_settings['US_max_things'] ?></span>
                        </span>
                <?php
                        break;
                    case 'airport':
                        echo '<span class="text-muted fr" id="cooldown_airport">Klar</span>';
                        break;
                }

                ?>
            </div>
        <?php
        }
        ?>
    </div>

    <<<<<<< HEAD <script>
        $(document).ready(function() {
        $('#bunker_in').click(function() {
        if ($("#bunker_in.bg-green")[0]) {
        $("#bunker_in").removeClass("bg-green");
        $("#bunker_in").addClass("bg-orange");
        $("#bunker_in").text("Gå ut av bunker");
        } else {
        $("#bunker_in").removeClass("bg-orange");
        $("#bunker_in").addClass("bg-green");
        $("#bunker_in").text("Gå i bunker");
        }
        =======
        <script>
            $(document).ready(function() {
                $('#bunker_in').click(function() {
                    if ($("#bunker_in.bg-green-lt")[0]) {
                        $("#bunker_in").removeClass("bg-green-lt");
                        $("#bunker_in").addClass("bg-orange-lt");
                        $("#bunker_in").text("Gå ut av bunker");
                    } else {
                        $("#bunker_in").removeClass("bg-orange-lt");
                        $("#bunker_in").addClass("bg-green-lt");
                        $("#bunker_in").text("Gå i bunker");
                    } >>>
                    >>> > main

                })
            })
        </script>