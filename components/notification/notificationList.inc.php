<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$notifications = DB::run("SELECT COUNT(NO_text) FROM notification WHERE NO_acc_id = ? AND NO_unread = ?", [$session_id, 1])->fetchColumn();

$unread_string = $notifications > 1 ? 'uleste varsler' : 'ulest varsel';

?>

<div class="card">
    <div class="card-header">
        <div class="col text-truncate">
            <div class="text-body d-block">
                <h3 class="card-title lh-sm">Varsler</h3>
            </div>
            <div class="d-block text-muted text-truncate mt-n1">
                <?= $notifications > 0 ? $notifications . ' ' . $unread_string : 'Ingen uleste varsler' ?>
            </div>
        </div>
    </div>
    <?php

    $stmt = DB::run("SELECT NO_text, NO_date, NO_unread FROM notification WHERE NO_acc_id=? ORDER BY NO_unread", [$session_id]);
    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

    ?>
        <div class="list-group list-group-flush list-group-hoverable">
            <div class="list-group-item">
                <div class="row align-items-center">
                    <?php if ($row['NO_unread'] == 1) { ?><div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div><?php } ?>
                    <div class="col text-truncate">
                        <div class="text-body d-block"><?= $row['NO_text'] ?></div>
                        <div class="d-block text-muted text-truncate mt-n1">
                            <?= date_to_text($row['NO_date']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="list-group list-group-flush list-group-hoverable">
        <div class="dropdown-item cursor-pointer" hx-post="actions/notifications/notifications.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML">
            Åpne i ny side
        </div>
    </div>
</div>