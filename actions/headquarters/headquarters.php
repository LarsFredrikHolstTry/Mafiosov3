<?php

include 'headquartersVariables.inc.php';

?>
<div class="col-12" id="container">
    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->headquarter; ?></h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <?php if ($AS_row['AS_rank'] == 12) { ?>
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <h3 class="mb-1">På tide med en ny start?</h3>
                        <p>Du har oppnådd den øverste ranken på Mafioso, nemlig ranken Capo Di Tutti Capi og har derfor mulighet for å restarte ranken på samme bruker!
                            <br>
                            Dersom du ønsker å starte på nytt starter du med 0 exp, mister alt av biler,
                            ting og alle dine penger. Du vil få en overførelses-ban på
                            4 dager og har da ikke lov å sende eller motta penger
                            fra andre spillere. Du har heller ikke lov å selge eller
                            kjøpe
                            eobjekter på markedet i denne tiden.

                        </p>
                        <div class="btn-list">
                            <a href="#" class="btn btn-info">Start på nytt!</a>
                            <a href="#" class="btn">Skjul melding</a>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>

                <?php } ?>
                <div class="row">
                    <div class="col-6">
                        <h3>Personlig statistikk</h3>
                        <address>
                            EXP: <?= number($AS_row['AS_exp'] ?? 0) ?><br>
                            EXP i dag: <?= number($DS_row['DS_exp'] ?? 0) ?><br>
                            Penger ute: <?= number($AS_row['AS_money'] ?? 0) ?> kr<br>
                            Penger i banken: <?= number($AS_row['AS_bankmoney'] ?? 0) ?> kr<br>
                            Antall poeng: <?= number($AS_row['AS_points'] ?? 0) ?><br>
                            Kriminalitet utført i dag: <?= number($DS_row['DS_crime'] ?? 0) ?><br>
                            Biltyveri utført i dag: <?= number($DS_row['DS_carTheft'] ?? 0) ?><br>
                            Brekk utført i dag: <?= number($DS_row['DS_theft'] ?? 0) ?><br>
                            Stjel utført i dag: <?= number($DS_row['DS_steal'] ?? 0) ?><br>
                        </address>
                    </div>
                    <div class="col-6">
                        <h3>Dagens oppdrag</h3>
                        <div hx-get="actions/headquarters/daily_achievement.inc.php" id="daily_achievement" hx-trigger="daily_achievement, load"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>