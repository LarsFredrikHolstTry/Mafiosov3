<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/ranks.php';

$health =         DB::run("SELECT AS_health FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();

if ($health === false) {
    DB::run(
        "INSERT INTO account_stat (AS_id, AS_money, AS_bankmoney, AS_EXP, AS_rank, AS_health, AS_points, AS_bullets, AS_city, AS_mission, AS_fightpoints, AS_avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [$session_id, 1000, 0, 0, 0, 100, 0, 0, 0, 0, 0, 'img/avatars/standard_avatar.png']
    );
    $health = DB::run("SELECT AS_health FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();
}

?>
<div class="d-flex mb-2">
    <div><span class="d-inline-flex align-items-center lh-1">Helse</span></div>
    <div class="ms-auto">
        <span class="text-muted d-inline-flex align-items-center lh-1">
            <?= $health <= 0 ? 'Død' : $health . '%' ?>
        </span>
    </div>

</div>
<div class="progress progress-sm">
    <div class="progress-bar <?= $health >= 50 ? 'bg-green' : ($health >= 20 ? 'bg-orange' : 'bg-red') ?>" style="width: <?= $health ?>%" role="healthbar">
    </div>
</div>
