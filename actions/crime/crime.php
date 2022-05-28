<?php

include '../../global-variables.php';

$crime[0] = "Ran Storo Storsenter";
$crime[1] = "Ran Oslo City";
$crime[2] = "Ran Byporten Shopping";
$crime[3] = "Ran Steen & Strøm Magasin";
$crime[4] = "Ran Glassmagasinet Oslo";
$crime[5] = "Ran Eger Karl Johan";
$crime[6] = "Ran Eger Paleet";
$crime[7] = "Ran narkotika";
$crime[8] = "Ran banken";

?>
<div class="card col-6" id="container">
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
                                <tr>
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