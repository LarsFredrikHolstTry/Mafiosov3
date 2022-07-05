<?php

include '../../global-variables.php';
include '../../functions/ranks.php';
include '../../db/PDODB.php';

?>
<div class="col-12" id="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->playersOnline; ?></h3>
            </h3>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>Mafioso</th>
                        <th>Sist aktiv</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $differanse = time() - 1800;
                    $stmt = DB::run("SELECT ACC_id, ACC_username, ACC_last_active from account WHERE ACC_last_active > $differanse");
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                        $AS_row =        DB::run("SELECT AS_rank, AS_avatar FROM account_stat WHERE AS_id = ?", [$row['ACC_id']])->fetch();

                    ?>
                        <tr>
                            <td data-label="Name">
                                <div class="d-flex py-1 align-items-center">
                                    <span class="avatar me-2" style="background-image: url(<?= $AS_row['AS_avatar'] ?>)"></span>
                                    <div class="flex-fill">
                                        <div hx-post="actions/myProfile/myProfile.php?id=<?= $row['ACC_id'] ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer font-weight-medium"><?= $row['ACC_username'] ?></div>
                                        <div class="text-muted"><?= $rank_arr[$AS_row['AS_rank']] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Title">
                                <div class="text-muted"><?= date_to_text($row['ACC_last_active']) ?></div>
                            </td>
                        </tr>
                    <?php

                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

</script>