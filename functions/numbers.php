<?php

/**
 * Format numbers to readable numbers with space between
 *
 * @param int
 *
 * @return int
 */
function number(int $amount)
{
    if (!is_numeric($amount) || $amount == null || $amount == '') {
        return 0;
    } else {
        return number_format($amount, 0, '.', ' ');
    }
}

/**
 * Return number without spacing between
 *
 * @param int
 *
 * @return int
 */
function removeSpace($number)
{
    return str_replace(' ', '', $number);
}
