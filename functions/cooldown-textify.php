<?php

function seconds_to_minutes_and_seconds($seconds)
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;

    if ($minutes > 0 && $seconds == 0) {
        return $minutes . ' min';
    } elseif ($minutes != 0) {
        return $minutes . ' min ' . $seconds . ' sek';
    } else {
        return $seconds . ' sek';
    }
}
