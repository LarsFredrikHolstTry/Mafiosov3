<?php

include '../../global-variables.php';
include 'fightClubVariables.inc.php';
include '../../db/PDODB.php';

$fightPoints = DB::run("SELECT AS_fightpoints FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->fightClub; ?></h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image mb-2" src="actions/fightClub/img/fightClub.png" />
                <div class="col-12 df jcc aic mb-2">
                    <span class="status status-blue">Slåsspoeng: <?= number($fightPoints) ?></span>
                    <!-- <span class="ml-05 text-muted">Topp 10%</span> -->
                </div>
                <div class="row">
                    <div class="col-6">
                        <h3>Trening</h3>
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Slåsspoeng</th>
                                        <th>Ventetid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($category); $i++) { ?>
                                        <tr class="cursor-pointer" id="<?= $i; ?>">
                                            <td>Tren <?= $category[$i] ?></td>
                                            <td>+<?= $addon[$i] ?></td>
                                            <td class="text-muted"><?= $cooldown[$i] ?>s</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <h3>Slåsskamp</h3>
                        <div class="btn btn-secondary cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-karate" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="18" cy="4" r="1"></circle>
                                <path d="M3 9l4.5 1l3 2.5"></path>
                                <path d="M13 21v-8l3 -5.5"></path>
                                <path d="M8 4.5l4 2l4 1l4 3.5l-2 3.5"></path>
                            </svg>
                            Finn slåsskamp
                        </div>
                        <h3 class="mt-2">Siste kamper</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var value = value;
            $("#feedback-container").load("components/feedback.html");
        })
    })
</script>