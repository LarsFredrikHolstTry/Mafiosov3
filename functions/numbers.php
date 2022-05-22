<?php

/**
 * Format numbers to readable numbers with space between
 *
 * @param int
 *
 * @return int
 */
function number($amount)
{
    if ($amount == null || $amount == '') {
        return 0;
    } else {
        return number_format($amount, 0, '.', ' ');
    }
}
