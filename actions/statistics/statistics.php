<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/ranks.php';
include '../../functions/money_ranks.php';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Statistikk</h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h3>Topp 10 spillere (rank)</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Mafioso</th>
                                    <th>rank</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $i = 0;

                                $stmt = DB::run("SELECT 
                                account_stat.AS_id, account.ACC_username, account_stat.AS_rank,
                                account.ACC_username as username
                                FROM 
                                account_stat, account
                                WHERE
                                account_stat.AS_id = account.ACC_id
                                AND 
                                account.ACC_status = 0
                                ORDER BY account_stat.AS_exp DESC
                                LIMIT 10");
                                while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td class="text-muted"><?= $i ?>.</td>
                                        <td>
                                            <span hx-post="actions/myProfile/myProfile.php?id=<?= $row['AS_id'] ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer font-weight-medium"><?= $row['username'] ?></span>
                                        </td>
                                        <td class="text-muted"><?= $rank_arr[$row['AS_rank']] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <h3>Topp 10 spillere (penger)</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Mafioso</th>
                                    <th>rank</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $i = 0;

                                $stmt = DB::run("SELECT 
                                account_stat.AS_id, (account_stat.AS_money + account_stat.AS_bankmoney) as total_money,
                                account.ACC_username as username
                                FROM 
                                account_stat, account
                                WHERE
                                account_stat.AS_id = account.ACC_id
                                AND 
                                account.ACC_status = 0
                                ORDER BY total_money DESC
                                LIMIT 10");
                                while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td class="text-muted"><?= $i ?>.</td>
                                        <td>
                                            <span hx-post="actions/myProfile/myProfile.php?id=<?= $row['AS_id'] ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer font-weight-medium"><?= $row['username'] ?></span>
                                        </td>
                                        <td class="text-muted"><?= money_rank($row['total_money']) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
            $("#feedback-container").load("components/feedback.php");
        })
    })
</script>