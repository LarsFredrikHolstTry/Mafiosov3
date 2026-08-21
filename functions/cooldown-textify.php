<?php

function seconds_to_minutes_and_seconds($seconds)
{
    $seconds = max(0, (int) round($seconds));
    $minutes = intdiv($seconds, 60) % 60;
    $seconds = $seconds % 60;

    if ($minutes > 0 && $seconds == 0) {
        return $minutes . ' min';
    } elseif ($minutes != 0) {
        return $minutes . ' min ' . $seconds . ' sek';
    } else {
        return $seconds . ' sek';
    }
}
