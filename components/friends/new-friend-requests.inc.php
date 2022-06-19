<?php
include '../../global-variables.php';
include '../../db/PDODB.php';

$friend_requests = DB::run("SELECT COUNT(FR_acc_id) FROM friendrequests WHERE FR_acc_id = ?", [$session_id])->fetchColumn();

if ($friend_requests > 0) {
    echo '<span class="badge badge-pill bg-blue">' . $friend_requests . '</span>';
}
