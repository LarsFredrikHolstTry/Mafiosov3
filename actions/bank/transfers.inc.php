<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

?>

<div class="table-responsive">
    <table class="table table-vcenter">
        <thead>
            <tr>
                <th style="width: 25%;">Mafioso</th>
                <th>Sum</th>
                <th>Melding</th>
                <th>Dato</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $stmt = DB::run("SELECT BT_from, BT_to, BT_money, BT_date, BT_message from bank_transfer WHERE BT_from = ? OR BT_to = ? ORDER BY BT_date DESC", [$session_id, $session_id]);
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                if ($row['BT_from'] == $session_id) {
                    $receiver = $row['BT_to'];
                } else {
                    $receiver = $row['BT_from'];
                }

                $username =  DB::run("SELECT ACC_username FROM account WHERE ACC_id = ?", [$receiver])->fetchColumn();

            ?>
                <tr>
                    <td><span>
                            <?=

                            $row['BT_from'] == $session_id ? '<span class="text-muted">Til: </span>' : '<span class="text-muted">Fra: </span>';

                            ?>
                            <span hx-post="actions/myProfile/myProfile.php?id=<?= $receiver ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer font-weight-medium"><?= $username ?></span>
                        </span></td>
                    <td><?=
                        $row['BT_from'] == $session_id
                            ?
                            '<span class="badge bg-red-lt">- ' . number($row['BT_money']) .  ' kr</span>'
                            :
                            '<span class="badge bg-green-lt">+ ' . number($row['BT_money']) . ' kr</span>' ?></td>
                    <td><?= strlen($row['BT_message']) > 0 ? $row['BT_message'] : '<i class="text-muted">Ingen melding</i>'; ?></td>
                    <td class="text-muted"><?= date_to_text($row['BT_date']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>