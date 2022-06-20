<?php
include '../../global-variables.php';
include '../../db/PDODB.php';

$notifications = DB::run("SELECT COUNT(NO_text) FROM notification WHERE NO_acc_id = ? AND NO_unread = ?", [$session_id, 1])->fetchColumn();

$unread_string = $notifications > 0 ? 'uleste varsler' : 'ulest varsel';

if ($notifications > 0) {
    echo '
    <span class="badge badge-pill bg-red-lt">' . $notifications . '</span>';
}
