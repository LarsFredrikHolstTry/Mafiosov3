<?php


include '../../global-variables.php';
include '../../db/PDODB.php';

?>

<div class="col-12">
    <div class="row row-cards">
        <?php

        foreach ($topActionBar as $key => $value) {

            $isJail = $key == 'jail';

            if (!$isJail) {
                if ($key == 'fightClub') {
                    $cd_name = 'fc_training';
                } else {
                    $cd_name = $key;
                }

                $cd =   DB::run("SELECT CD_" . $cd_name . " FROM cooldown WHERE CD_acc_id = ?", [$session_id])->fetchColumn();
                $timeleft = $cd > time() ? $cd - time() : 'Klar';
            }

            $hasTimeout = is_numeric($timeleft) && $timeleft > 0;
        ?>
            <div class="col-2">
                <a hx-post="actions/<?= $key ?>/<?= $key ?>.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="no-style" href="#">
                    <div class="btn bg-dark btn-md w-100">
                        <div class=" row align-items-center">
                            <div class="col">
                                <div class="font-weight-medium">
                                    <?= $value ?>
                                </div>
                                <span class="<?= $hasTimeout && !$isJail ? 'text-danger' : 'text-success'; ?>" id="cooldown_<?= $key ?>">
                                    <?= $isJail ? 'Ingen i fengsel' : $timeleft; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php if ($hasTimeout && !$isJail) { ?>
                <script>
                    countdown(<?= $timeleft ?>, "cooldown_<?= $key ?>", "cooldown_<?= $key ?>");
                </script>
            <?php } ?>
        <?php } ?>
    </div>
</div>