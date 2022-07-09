<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$ACC_row =  DB::run("SELECT * FROM account WHERE ACC_id = ?", [$session_id])->fetch();
$AS_row =   DB::run("SELECT * FROM account_stat WHERE AS_id = ?", [$session_id])->fetch();

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
                            kjøpe objekter på markedet i denne tiden.

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
                    </div>
                    <div class="col-6">
                        <h3>Dagens oppdrag</h3>
                        <div>
                            <div class="d-flex mb-1 mt-3">
                                <div><span class="d-inline-flex align-items-center lh-1">kriminalitet</span></div>
                                <div class="ms-auto">
                                    <span class="text-muted d-inline-flex align-items-center lh-1">
                                        20 av 10
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex mb-1 mt-3">
                                <div><span class="d-inline-flex align-items-center lh-1">Biltyveri</span></div>
                                <div class="ms-auto">
                                    <span class="text-muted d-inline-flex align-items-center lh-1">
                                        5 av 10
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-orange" style="width: 50%">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex mb-1 mt-3">
                                <div><span class="d-inline-flex align-items-center lh-1">Brekk</span></div>
                                <div class="ms-auto">
                                    <span class="text-muted d-inline-flex align-items-center lh-1">
                                        3 av 10
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-orange" style="width: 30%">
                                </div>
                            </div>
                        </div>
                        <p class="mt-3">Belønning: 50 EXP og 50 000kr</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>