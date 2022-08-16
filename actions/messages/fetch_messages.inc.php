<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$id = $_GET['id'];

function pm_from($text, $date)
{
    echo '
    <div class="card card-sm highlight" style="margin: 5px; width: 300px;">
        <div class="card-body">
            <p>' . $text . '</p>
            <p class="text-muted">' . date_to_text($date) . '</p>
        </div>
    </div>';
}

function pm_to($text, $date)
{
    echo '
    <div class="card card-sm bg-indigo" style="float: right; margin: 5px; width: 300px;">
        <div class="card-body">
            <p>' . $text . '</p>
            <p>' . date_to_text($date) . '</p>
        </div>
    </div>';
}

$stmt = DB::run("SELECT * FROM pm WHERE PM_uniqueId = '" . $id . "' ORDER BY PM_date ASC");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

    $userId =       $row['PM_from'] != $session_id ? $row['PM_to'] : $row['PM_from'];
    $fromOrTo =     $row['PM_from'] != $session_id ? 'from' : 'to';

    switch ($fromOrTo) {
        case 'to':
            pm_to($row['PM_message'], $row['PM_date']);
            break;
        case 'from':
            pm_from($row['PM_message'], $row['PM_date']);
            break;
    }
}
