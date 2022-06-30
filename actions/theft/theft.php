<?php

include '../../global-variables.php';
include '../../functions/cooldown-textify.php';

$theftArr[0] = "Ran tatovering studio";
$theftArr[1] = "Ran restaurant";
$theftArr[2] = "Stjel verktøy fra byggeplass";
$theftArr[3] = "Ran casino";

$cooldown[0] = 130;
$cooldown[1] = 260;
$cooldown[2] = 420;
$cooldown[3] = 600;

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->theft; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/theft/img/brekk.png" />
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Handling</th>
                                <th>Sjanse</th>
                                <th>Ventetid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($theftArr); $i++) { ?>
                                <tr class="do-crime cursor-pointer" id="<?= $i; ?>">
                                    <td><?= $theftArr[$i]; ?></td>
                                    <td class="text-muted">100%</td>
                                    <td class="text-muted"><?= seconds_to_minutes_and_seconds($cooldown[$i]); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>