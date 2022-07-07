<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/ranks.php';

$health =         DB::run("SELECT AS_health FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();

?>
<div class="d-flex mb-2">
    <div><span class="d-inline-flex align-items-center lh-1">Helse</span></div>
    <div class="ms-auto">
        <span class="text-muted d-inline-flex align-items-center lh-1">
            <?= $health ?>%
        </span>
    </div>

</div>
<div class="progress progress-sm">
    <div class="progress-bar <?= $health >= 50 ? 'bg-green' : ($health >= 20 ? 'bg-orange' : 'bg-red') ?>" style="width: <?= $health ?>%" role="healthbar">
    </div>
</div>