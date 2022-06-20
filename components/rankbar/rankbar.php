<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/ranks.php';

$user =         DB::run("SELECT AS_rank, AS_EXP FROM account_stat WHERE AS_id=?", [$session_id])->fetch();

?>
<h3>Rankbar</h3>
<div class="d-flex mb-2">
    <div> <?= rank_progress($user['AS_rank'], $user['AS_EXP'], $rank_from, $rank_to) ?>% <span class="text-muted d-inline-flex align-items-center lh-1">til <?= $rank_arr[$user['AS_rank'] + 1]; ?></span></div>
    <div class="ms-auto">
        <span class="text-muted d-inline-flex align-items-center lh-1">
            <?= $user['AS_EXP'] ?> EXP
        </span>
    </div>
</div>
<div class="progress progress-sm">
    <div class="progress-bar bg-blue" style="width: <?= rank_progress($user['AS_rank'], $user['AS_EXP'], $rank_from, $rank_to) ?>%" role="progressbar" aria-valuenow="<?= rank_progress($user['AS_rank'], $user['AS_EXP'], $rank_from, $rank_to) ?>" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
    </div>
</div>