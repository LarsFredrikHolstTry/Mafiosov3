<?php

include '../../global-variables.php';

$crime[0] = "Veldig enkel";
$crime[1] = "Enkel";
$crime[2] = "Middels";
$crime[3] = "Vanskelig";
$crime[4] = "Avansert";
$crime[5] = "Ekspert";


?>
<div class="col-12" id="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->crime; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/crime/img/kriminalitet.png" />
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Handling</th>
                                <th>Sjanse</th>
                                <th>Ventetid</th>
                                <th class="w-1">Utbetaling</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($crime); $i++) { ?>
                                <tr class="cursor-pointer">
                                    <td><?= $crime[$i]; ?></td>
                                    <td class="text-muted">100%</td>
                                    <td class="text-muted">Lorem</td>
                                    <td class="text-muted">Lorem</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>