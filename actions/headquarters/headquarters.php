<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$ACC_row =  DB::run("SELECT * FROM account WHERE ACC_id = $session_id")->fetch();
$AS_row =   DB::run("SELECT * FROM account_stat WHERE AS_id = $session_id")->fetch();

$DC_row =   DB::run("SELECT * FROM daily_challenge")->fetch();
$DS_row =   DB::run("SELECT * FROM daily_stats WHERE DS_acc_id = $session_id")->fetch();

$daily_challenges[0] = 'crime';
$daily_challenges[1] = 'carTheft';
$daily_challenges[2] = 'theft';

$title[0] = "Kriminalitet";
$title[1] = "Biltyveri";
$title[2] = "Brekk";

$exp_pr_activity = 2;
$money_pr_activity = 2500;

$exp = 0;
$money = 0;

$done = true;

?>
<div class="col-12" id="container">
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
                            EXP: 0<br>
                            EXP i dag: 0<br>
                            Penger ute: Ipsum<br>
                            Penger i banken: Ipsum<br>
                            Antall poeng: Ipsum<br>
                            Kriminalitet utført i dag: 0<br>
                            Biltyveri utført i dag: 0<br>
                            Brekk utført i dag: 0<br>
                            Stjel utført i dag: 0<br>
                            Utbrytninger utført i dag: 0<br>
                        </address>
                    </div>
                    <div class="col-6">
                        <h3>Dagens oppdrag</h3>
                        <?php for ($i = 0; $i < count($daily_challenges); $i++) {
                            $percentage = ($DS_row['DS_' . $daily_challenges[$i]] / $DC_row['DC_' . $daily_challenges[$i]]) * 100;
                            $exp =      $exp + $exp_pr_activity * $DC_row['DC_' . $daily_challenges[$i]];
                            $money =    $money + $money_pr_activity * $DC_row['DC_' . $daily_challenges[$i]];

                            if ($DS_row['DS_' . $daily_challenges[$i]] < $DC_row['DC_' . $daily_challenges[$i]]) {
                                $done = false;
                            }

                        ?>
                            <div>
                                <div class="d-flex mb-1 mt-3">
                                    <div><span class="d-inline-flex align-items-center lh-1"><?= $title[$i] ?></span></div>
                                    <div class="ms-auto">
                                        <span class="text-muted d-inline-flex align-items-center lh-1">
                                            <?= $DS_row['DS_' . $daily_challenges[$i]] ?> av <?= $DC_row['DC_' . $daily_challenges[$i]] ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" style="width: <?= $percentage ?>%">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- <p class="mt-3">Belønning: <?= number($exp) ?> EXP og <?= number($money) ?> kr</p> -->

                        <?php if ($done) { ?>
                            <div class="btn btn-square mt-3">
                                Hent belønning
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>