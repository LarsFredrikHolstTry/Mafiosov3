<?php

function date_to_text(int $date)
{
    $month_short = [" ", "Jan", "Feb", "Mars", "April", "Mai", "Juni", "Juli", "Aug", "Sep", "Okt", "Nov", "Des"];

    $isTomorrow = date('Ymd', $date) == date('Ymd', strtotime('tomorrow'));
    $isYesterday = date('Ymd', $date) == date('Ymd', strtotime('yesterday'));
    $isToday = date('d', $date) == date('d', time()) && date('m', $date) == date('m', time()) && date('y', $date) == date('y', time());

    if ($isTomorrow) {
        $date_format = 'I morgen ';
        $style = 'tomorrow';
    } elseif ($isYesterday) {
        $date_format = 'I går ';
        $style = 'yesterday';
    } elseif ($isToday) {
        $date_format = 'I dag ';
        $style = 'today';
    } else {
        $date_format = date('d', $date) . ". " . $month_short[date('n', $date)] . " 20" . date('y', $date);
        $style = 'later';
    }

    if ($style == 'tomorrow') {
        return '<span style="color: #087fef;">' . $date_format . " " . date('H:i', $date) . '</span>';
    } elseif ($style == 'today') {
        return '<span style="color: var(--ready-color);">' . $date_format . " " . date('H:i', $date) . '</span>';
    } elseif ($style == 'yesterday') {
        return '<span style="color: orange;">' . $date_format . " " . date('H:i', $date) . '</span>';
    } elseif ($style == 'later') {
        return $date_format . " " . date('H:i', $date);
    }
}
