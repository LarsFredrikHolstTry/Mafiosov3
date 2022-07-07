<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/ranks.php';

$user =         DB::run("SELECT AS_rank, AS_EXP FROM account_stat WHERE AS_id=?", [$session_id])->fetch();

?>
<div class="d-flex mb-2">
    <?php if ($user['AS_rank'] == 12) {

    ?>
        <div><span class="text-muted d-inline-flex align-items-center lh-1"><?= $rank_arr[$user['AS_rank']]; ?></span></div>
        <div class="ms-auto">
            <span class="text-muted d-inline-flex align-items-center lh-1">
                <?= number($user['AS_EXP']) ?> EXP
            </span>
        </div>
    <?php
    } else {
        check_rankup($session_id, $user['AS_rank'], $user['AS_EXP'], $rank_from, $rank_to, $rank_prize);
    ?>
        <div> <?= number(rank_progress($user['AS_rank'], $user['AS_EXP'], $rank_from, $rank_to)) ?>% <span class="text-muted d-inline-flex align-items-center lh-1">til <?= $rank_arr[$user['AS_rank'] + 1]; ?></span></div>
        <div class="ms-auto">
            <span class="text-muted d-inline-flex align-items-center lh-1">
                <?= $user['AS_EXP'] ?> EXP
            </span>
        </div>
    <?php
    }
    ?>
</div>
<div class="progress progress-sm">
    <div class="progress-bar bg-blue" style="width: <?= $user['AS_rank'] == 12 ? '100' : rank_progress($user['AS_rank'], $user['AS_EXP'], $rank_from, $rank_to) ?>%" role="progressbar" aria-valuenow="<?= rank_progress($user['AS_rank'], $user['AS_EXP'], $rank_from, $rank_to) ?>" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
    </div>
</div>